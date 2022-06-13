# Entities
Entities act like tables in your database. Place all the attributes, you want to handle in your database as member variables.

## Example
```php
class Order extends Entity implements JsonSerializable {
    private $tabname = "orders";
    public $item, $quantity, $datetime, $completed;

    public function __construct(int $id, ?Item $item = null, int $quantity = 0, ?DateTime $datetime = null, bool $completed = false)
    {
        $this->id = $id;
        $this->item = $item;
        $this->quantity = $quantity;
        $this->datetime = $datetime;
        $this->completed = $completed;
    }

    public function loadFromDB(DB $db) : bool
    {
        $data = parent::_fetchFromId($db, $this->tabname);
        if ($data === false) {
            return false;
        }

        $item = new Item($data["item"]);
        $item->loadFromDB($db);

        $this->item = $item;
        $this->quantity = $data["quantity"];
        $this->datetime = DateTime::createFromFormat('Y-m-d H:i:s', $data["date"]);
        $this->completed = $data["completed"] == 1;
        return true;
    }

    public function saveToDB(DB $db) : ?object
    {
        $itemId = $this->item->getId();

        if ($this->doesExistInDB($db, $this->tabname)) {
            $updateStatement = $db->getConnection()->prepare("UPDATE orders SET completed=:completed WHERE id=:id");
            $updateStatement->bindParam(":id", $this->id, PDO::PARAM_INT);
            $updateStatement->bindParam(":completed", $this->completed, PDO::PARAM_BOOL);
            $updateStatement->execute();
        } else {
            // Insert
            $insertStatement = $db->getConnection()->prepare("INSERT INTO " . $this->tabname . " (item, quantity) VALUES (:item, :quantity)");
            $insertStatement->bindParam(":item", $itemId, PDO::PARAM_STR);
            $insertStatement->bindParam(":quantity", $this->quantity, PDO::PARAM_INT);
            if (!$insertStatement->execute()) {
                return null;
            }
            $this->id = $db->getConnection()->lastInsertId();
            $this->loadFromDB($db); // Refresh the content.
        }
        return $this;
    }

    /**
     * Returns the total price of the order.
     */
    private function getTotalPrice() {
        return $this->quantity * $this->item->price;
    }

    /**
     * Marks the current order as complete.
     */
    public function markAsComplete() {
        $this->completed = true;
    }

    public function jsonSerialize(): mixed
    {
        $vars = Validation::getObjectPublicVars($this);
        $vars["totalPrice"] = $this->getTotalPrice();
        return $vars;
    }
}
```