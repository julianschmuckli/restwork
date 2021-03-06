<?php
namespace Julianschmuckli\Restwork\Helper;
use \PDO;

class DB
{
    private $host, $dbname, $username, $password;
    private $conn = null;

    /**
     * Assigns the credentials to the DB object.
     * @param {String} $host The host string
     * @param {String} $dbname The database name
     * @param {String} $username The username, with the privileges to perform the SQL statements.
     * @param {String} $password The unencrypted password for the username.
     */
    public function __construct(String $host, String $dbname, String $username, String $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Gets the PDO connection variable.
     * @return {PDO} The real PDO object, which can be used to create prepared statements, etc.
     */
    public function getConnection(): PDO
    {
        if ($this->conn === null) {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }
        return $this->conn;
    }
}
