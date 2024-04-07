<?php

namespace App\Services;

use PDO;
use stdClass;

class DbHelper
{
    private $_conn;
    private $stmt;

    /**
     * Inject the curremt db connection
     * 
     * @param PDO $conn PDO connection instance
     * @return void
     */
    public function __construct(PDO $conn)
    {
        $this->_conn = $conn;
    }

    /**
     * Prepare the SQL query
     * 
     * @param string $query Raw SQL query
     * @param array $params Query parameters
     * @return void
     */
    public function query(string $query, array $params = []): void
    {
        $this->stmt = $this->_conn->prepare($query);
        empty($params) ? $this->stmt->execute() : $this->stmt->execute($params);
    }

    /**
     * Get the row count of the result
     * 
     * @return int
     */
    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }

    /**
     * Return the first row from the results
     * 
     * @return object \stdClass
     */
    public function fetch(): stdClass
    {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get all the rows from the results
     * 
     * @return array
     */
    public function fetchAll(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
}