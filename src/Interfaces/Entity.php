<?php
namespace Julianschmuckli\Restwork\Interfaces;
use Julianschmuckli\Restwork\Helper\DB;
use \PDO;

abstract class Entity
{
    public $id; // Every entity should have an identifier for the objects.

    /**
     * Loads the data from the database to the object, after the object has been initialized just with the id for example.
     * @return bool If true, the operation to fetch the data and assign it to the properties was successful.
     */
    public abstract function loadFromDB(DB $db): bool;

    /**
     * Checks if the object is already represented in the database.
     */
    public function doesExistInDB(DB $db, string $tablename)
    {
        if ($this->id == 0) {
            return false;
        }
        $checkInDB = $db->getConnection()->prepare("SELECT * FROM " . $tablename . " WHERE id = :id");
        $checkInDB->bindParam(":id", $this->id, PDO::PARAM_INT);
        $checkInDB->execute();
        return $checkInDB->rowCount() == 1;
    }

    /**
     * Saves the data in the object to the database
     * @return object|null Returns the updated object, if the operation was successful, returns null if not.
     */
    public abstract function saveToDB(DB $db): ?object;

    protected function _fetchFromId(DB $db, string $tablename)
    {
        $fetch = $db->getConnection()->prepare("SELECT * FROM " . $tablename . " WHERE id = :id");
        $fetch->bindParam(":id", $this->id, PDO::PARAM_INT);
        $fetch->execute();

        if ($fetch->rowCount() === 0) {
            return false;
        }

        $data = $fetch->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
