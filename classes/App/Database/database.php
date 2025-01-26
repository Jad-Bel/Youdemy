<?php

namespace Youco\Youdemy\App\Database;

class Database
{
    private $host = "localhost";
    private $db_name = "youdemy";
    private $username = "root";
    private $password = "Hitler20.";
    private $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new \PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \Exception("Connection error: " . $e->getMessage());
        }
        return $this->conn;
    }
}