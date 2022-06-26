# Usage
The framework is designed, that every route you create, is assigned to a service. Therefore you always call your API later in this form.

```
https://<YOUR_DOMAIN>/<SERVICE>/<ROUTE>
```

Every route was provided with a HTTP method. This means you only can call the route, with this specific method.

## Example
In the following example, you see how a route has been registered in the service class `Test` and how it should be called later.
```php
parent::registerRoute("helloWorld", HttpMethod::GET, "HelloWorld");
```

API Call:
```
GET https://restwork.schmuckli.net/test/helloWorld
```

You find a detailed example with a complete [template repository here](https://github.com/julianschmuckli/restwork_example).