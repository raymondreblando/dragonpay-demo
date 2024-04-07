<?php

namespace Config;

use Exception;
use PDO;
use PDOException;

class Database
{
    private $conn;

    /**
     * Initialize a new PDO connection
     * 
     * @return void
     */
    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception('Database connect refuse to connect ' . $e->getMessage());
        }
    }

    /**
     * Return the established connection
     * 
     * @return PDO
     */
    public function connect(): PDO
    {
        return $this->conn;
    }
}