<?php

class Category
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function createCategory($name)
    {
        $sql = "INSERT INTO categories (name, created_at, updated_at) VALUES (:name, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name]);
        return $this->conn->lastInsertId();
    }

    public function updateCategory($id, $name)
    {
        $sql = "UPDATE categories SET name = :name, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id, 'name' => $name]);
        return $stmt->rowCount();
    }

    public function deleteCategory($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>