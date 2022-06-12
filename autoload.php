<?php
/**
 * Auto import all the custom files, which are not part of the _framework.
 */

define("CUSTOM_DIR", ".");

/**
 * Import all services classes
 */
$services = glob(CUSTOM_DIR . '/services/*.php');
foreach ($services as $service) {
    require_once($service);   
}

/**
 * Import all entites classes
 */
$entities = rsearch(CUSTOM_DIR . '/entities', '/.*\.php/');
foreach ($entities as $entity) {
    require_once($entity);   
}

/**
 * Import all DAO (Data access object) classes
 */
$daos = rsearch(CUSTOM_DIR . '/dao', '/.*\.php/');
foreach ($daos as $dao) {
    require_once($dao);   
}

/**
 * Import all route classes
 */
$routes = rsearch(CUSTOM_DIR . '/routes', '/.*\.php/');
foreach ($routes as $route) {
    require_once($route);   
}

// $regPattern should be using regular expression
// Source: https://stackoverflow.com/questions/17160696/php-glob-scan-in-subfolders-for-a-file
function rsearch($folder, $regPattern) {
    $dir = new RecursiveDirectoryIterator($folder);
    $ite = new RecursiveIteratorIterator($dir);
    $files = new RegexIterator($ite, $regPattern, RegexIterator::GET_MATCH);
    $fileList = array();
    foreach($files as $file) {
        $fileList = array_merge($fileList, $file);
    }
    return $fileList;
}