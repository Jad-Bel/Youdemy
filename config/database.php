<?php 

class database {
    private $host = 'localhost';
    private $db_name = 'youdemy';
    private $username = 'root';
    private $password = 'Hitler20.';
    private $conn;

    public function __construct () 
    {
        try {
            $this->conn = new PDO("mydql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new error ("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}