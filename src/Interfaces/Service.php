<?php
namespace Julianschmuckli\Restwork\Interfaces;
use Julianschmuckli\Restwork\Helper\HttpResponse;

interface Service
{
    /**
     * The setup process, when the service is called for the first time.
     * Register the routes inside of this method and setup the database connection.
     */
    public function setup();

    /**
     * The default output of the service.
     * @return {HttpResponse} Will return the content of the service.
     */
    public function output(): HttpResponse;
}
