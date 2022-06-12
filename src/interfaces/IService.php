<?php
namespace Julianschmuckli\Restwork;

interface Service
{
    /**
     * The setup process, when the service is called for the first time.
     * Register the routes
     */
    public function setup();

    /**
     * The default output of the service.
     */
    public function output(): HttpResponse;
}
