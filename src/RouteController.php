<?php
namespace Julianschmuckli\Restwork;

class RouteController
{
    private ServiceController $service;

    /**
     * Sets a service to the route. This method is usually called by the dispatcher.
     * Do not called it by yourself, if you not necessary need it.
     */
    public final function setService(ServiceController $service)
    {
        $this->service = $service;
    }

    /**
     * Returns the service, where the route is contained.
     */
    public final function getService(): ServiceController
    {
        return $this->service;
    }

    /**
     * Returns the documentation string of the route, which will be showed, when the service node has been called.
     */
    public function getDocumentation(): String
    {
        return "No documentation was provided.";
    }
}
