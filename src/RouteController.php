<?php
namespace Julianschmuckli\Restwork;

class RouteController
{
    private ServiceController $service;

    public final function setService(ServiceController $service)
    {
        $this->service = $service;
    }

    public final function getService(): ServiceController
    {
        return $this->service;
    }

    public function getDocumentation(): String
    {
        return "No documentation was provided.";
    }
}
