<?php
namespace App\Libraries;

use App\Helpers\ErrorHandler;
use PDO;

class Database
{
    private $Name = DB_NAME;
    private $User = DB_USER;
    private $Password = DB_PASSWORD;
    private $Host = DB_HOST;
    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->Host . ';dbname=' . $this->Name;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
        ];

        try {
            $this->dbh = new PDO($dsn, $this->User, $this->Password, $options);
        } catch (\PDOException $e) {
            ErrorHandler::serverError($e);
        }
    }

    /**
     * Prepares a SQL query for execution and sets it as the active prepared statement.
     * @return void
     */
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * Binds a value to a parameter in the prepared statement with the appropriate data type.
     * @return void
     */
    public function bind($param, $value, $type = null)
    {
        switch ($type === null) {
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }

        $this->stmt->bindValue($param, $value, $type);
    }


    /**
     * Execute a prepared SQL statement.
     * @return bool
     */
    public function execute()
    {
        try {
            return $this->stmt->execute();
        } catch (\PDOException $e) {
            ErrorHandler::serverError($e);
        }
    }

    /**
     * Executes the prepared statement and returns all rows as an array of objects.
     * @return array
     */
    public function resultSet()
    {
        $this->execute();
        try {
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            ErrorHandler::serverError($e);
        }
    }

    /**
     * Executes the prepared statement and returns a single row as an object.
     * @return mixed
     */
    public function result()
    {
        $this->execute();
        try {
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            ErrorHandler::serverError($e);
        }
    }

    /**
     * Get the number of the affected rows after am execution.
     * @return int
     */
    public function rowCount()
    {
        try {
            return $this->stmt->rowCount();
        } catch (\PDOException $e) {
            ErrorHandler::serverError($e);
        }
    }


}


