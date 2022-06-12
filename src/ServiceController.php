<?php
namespace Julianschmuckli\Restwork;

class ServiceController
{
    private $routes = [];
    private $db;

    /**
     * Registers a route, which can be called from the service later.
     */
    protected final function registerRoute(String $routeName, HttpMethod $method, String $routeClassName): bool
    {
        if (class_exists($routeClassName) && in_array("Route", class_implements($routeClassName))) {
            $route = array(
                "name" => $routeName,
                "method" => $method,
                "class" => $routeClassName
            );

            array_push($this->routes, $route);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sets the database for this service.
     */
    protected final function setDatabase(DB $database): void
    {
        $this->db = $database;
    }

    /**
     * Returns the database for this service.
     */
    public final function getDatabase(): DB
    {
        return $this->db;
    }

    /**
     * Returns the route depending on the name and HTTP method.
     */
    public final function getRoute(String $routeName, HttpMethod $method): ?Route
    {
        foreach ($this->routes as $route) {
            if ($route["name"] === $routeName && $route["method"] === $method) {
                $class = $route["class"];
                return new $class();
            }
        }
        return null;
    }

    /**
     * The default output of the service, showing all available routes.
     */
    public function output(): HttpResponse
    {
        if (count($this->routes) === 0) {
            $response = new HttpResponse(200);
            $response->setMessage("Connection established. No routes available on this service.");
            return $response;
        } else {
            $response = new HttpResponse(200);
            $response->setMessage("Welcome to this service.");

            $docRoutes = [];

            foreach ($this->routes as $route) {
                $class = $route["class"];
                $o = new $class();

                if ($o instanceof RouteController) {
                    $documentation = $o->getDocumentation();
                } else {
                    $documentation = "No documentation found.";
                }

                $method = $route["method"]->value;

                $doc = array(
                    "path" => $method . " /" . $route["name"],
                    "documentation" => $documentation
                );
                array_push($docRoutes, $doc);
            }

            $response->setBody($docRoutes);

            return $response;
        }
    }
}
