<?php
namespace Julianschmuckli\Restwork;
use \Exception;

class Dispatcher
{
    /**
     * Initializes the dispatcher, to start the service.
     */
    public function init()
    {
        $serviceName = Validation::string(@$_GET["service"]);

        if (empty($serviceName)) {
            $this->showError(400, "No service was provided");
        } else {
            $service = $this->getService($serviceName);
            if ($service instanceof Service) {
                $service->setup();

                $routeName = Validation::string(@$_GET["route"]);
                if (!empty($routeName)) {
                    if ($service instanceof ServiceController) {
                        $httpMethod = $this->getHttpMethod();
                        $data = $this->getInputData($httpMethod);
                        $route = $service->getRoute($routeName, $httpMethod);
                        if ($route == null) {
                            $this->showError(404, "The route was not found on the server.");
                        } else {
                            if ($route instanceof RouteController) {
                                $route->setService($service);
                            }
                            $route->input($data);
                            $response = $route->output();
                            if ($response instanceof HttpResponse) {
                                $response->output();
                            } else {
                                $error = new ErrorService(500, "No response was provided by this route.");
                                $error->output()->output();
                            }
                        }
                    } else {
                        $this->showError(500, "There was a configuration error.");
                    }
                } else {
                    // Call the service output, when no route was defined.
                    try {
                        $httpResponse = $service->output();
                        if ($httpResponse != null && $httpResponse instanceof HttpResponse) {
                            $httpResponse->output();
                        } else {
                            $error = new ErrorService(500, "No response was provided by the service.");
                            $error->output()->output();
                        }
                    } catch (Exception $ex) {
                        $this->showError(500, "Unexpected error occured.");
                    }
                }
            } else {
                $this->showError(500, "Unexpected error occured.");
            }
        }
    }

    private function getService($serviceName): Service
    {
        foreach (get_declared_classes() as $className) {
            if (in_array('Service', class_implements($className))) {
                if (strtolower($serviceName) == strtolower($className)) {
                    return new $className();
                }
            }
        }
        return new ErrorService(404, "No service was found for the name '$serviceName'.");
    }

    /**
     * Returns the HTTP method of the current request.
     */
    private function getHttpMethod(): HttpMethod
    {
        try {
            return HttpMethod::from($_SERVER['REQUEST_METHOD']);
        } catch (Exception $ex) {
            return HttpMethod::GET;
        }
    }

    /**
     * Returns the current input data from the depending HTTP method.
     */
    private function getInputData(HttpMethod $method)
    {
        switch ($method) {
            case HttpMethod::GET:
                return $_GET;
            case HttpMethod::POST:
            case HttpMethod::PUT:
            case HttpMethod::DELETE:
                $arr_data = array();
                $query_data = urldecode(file_get_contents('php://input'));
                if (is_object(json_decode($query_data))) {
                    $arr_data = json_decode($query_data, true);
                } else {
                    parse_str($query_data, $arr_data);
                }
                return $arr_data;
            default:
                return false;
        }
    }

    /**
     * Shows the error from the dispatcher directly.
     */
    private function showError($status, $message)
    {
        $errorService = new ErrorService($status, $message);
        $errorService->output()->output();
    }
}
