<?php

namespace App\Core\Database;

class Database
{
    private $host = "localhost";
    private $db_name = "youdemy";
    private $username = "postgres"; 
    private $password = "hitler20.";
    private $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new \PDO("pgsql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception("Connection error: " . $e->getMessage());
        }
        return $this->conn;
    }
}