# Services
A service is a component, which registers the routes, handles the connection the database and may even handle the authentication.

## Example
```php
class Shop extends ServiceController implements Service {
    public function setup() {
        /**
         * Database
         */
        $db = new DB("localhost", "DATABASE_NAME", "USERNAME", "PASSWORD");
        parent::setDatabase($db);

        /**
         * Routes
         */
        parent::registerRoute("createOrder", HttpMethod::POST, "CreateOrder");
        parent::registerRoute("listItems", HttpMethod::GET, "ListItems");
    }
}
```