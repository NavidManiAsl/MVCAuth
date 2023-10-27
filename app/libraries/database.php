<?php

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
        $dsn = 'mysql:host='. $this->Host . ';dbname='. $this->Name;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true,
        ];

        try {
            $this->dbh = new PDO($dsn, $this->User, $this->Password, $options);
            
            
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }


}


