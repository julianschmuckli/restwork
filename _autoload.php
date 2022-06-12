<?php
/**
 * Auto import all the _restwork files to support the framework.
 */

define("BASE_DIR", "./_restwork");

/**
 * Import all interfaces
 */
$interfaces = glob(BASE_DIR . '/interfaces/*.php');
foreach ($interfaces as $interface) {
    require_once($interface);   
}

/**
 * Import all helper classes
 */
$helpers = glob(BASE_DIR . '/helper/*.php');
foreach ($helpers as $helper) {
    require_once($helper);   
}

/**
 * Import all framework service classes
 */
$services = glob(BASE_DIR . '/services/*.php');
foreach ($services as $service) {
    require_once($service);   
}

/**
 * Import the controller and dispatcher.
 */
require_once BASE_DIR . "/Dispatcher.php";
require_once BASE_DIR . "/ServiceController.php";
require_once BASE_DIR . "/RouteController.php";