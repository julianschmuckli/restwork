# Routes
In this directory, you should create the routes, which will be later accessible through the REST service.

## Example
```php
class ListOrders extends RouteController implements Route {
    private $response;

    public function input($data) {
        $db = parent::getService()->getDatabase();

        $orderDAO = new OrderDAO($db);
        $orders = $orderDAO->getAll();

        $this->response = new HttpResponse(200);
        $this->response->setMessage("Showing all orders in the system.");
        $this->response->setBody($orders);
    }

    public function output() : ?HttpResponse {
        return $this->response;
    }
}
```