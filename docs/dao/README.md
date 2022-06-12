# DAO (Data Access Objects)
These classes are useful to perform the requests between the entities and routes. Also, they have the task to implement the CRUD logic for the database.

For example, you could build a DAO, to fetch a specific entry from the database or fetch all entries at once.

## Example
```php
class OrderDAO implements DAO
{
    private $db;
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function create($itemId, $quantity): HttpResponse
    {
        $pdo = $this->db->getConnection();
        $pdo->beginTransaction();

        $item = new Item($itemId);
        if ($item->loadFromDB($this->db)) {
            $order = new Order(0, $item, $quantity); // 0 to set it as a new object
            $order->saveToDB($this->db);

            if ($order->getId() !== 0) {
                $pdo->commit();

                $response = new HttpResponse(200);
                $response->setMessage("Order has been created.");
                $response->setBody($order);
                return $response;
            } else {
                $pdo->rollBack();

                $response = new HttpResponse(500);
                $response->setMessage("There was an error while creating the order.");
                return $response;
            }
        } else {
            $pdo->rollBack();

            $response = new HttpResponse(404);
            $response->setMessage("The item with id '" . $itemId . "' does not exist.");
            return $response;
        }
    }

    /**
     * Returns a single order by the id.
     */
    public function getById($orderId): ?Order
    {
        $order = new Order($orderId);
        if ($order->loadFromDB($this->db)) {
            return $order;
        }
        return null;
    }

    /**
     * Returns all orders of the system.
     * @return Order[]
     */
    public function getAll(): array
    {
        $fetchAll = $this->db->getConnection()->prepare("SELECT id FROM orders ORDER BY id DESC");
        $fetchAll->execute();

        $aOrders = $fetchAll->fetchAll(PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($aOrders as $oOrder) {
            $order = new Order($oOrder["id"]);
            $order->loadFromDB($this->db);

            array_push($orders, $order);
        }

        return $orders;
    }
}

```