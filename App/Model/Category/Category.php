<?php

namespace App\Model\Category;

use App\Core\Database\Database;

class Category
{
    private $conn;
    private $id;
    private $name;
    private $created_at;
    private $updated_at;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function createCategory($name)
    {
        $sql = "INSERT INTO categories (name, created_at, updated_at) VALUES (:name, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name]);

        $this->id = $this->conn->lastInsertId();

        return $this;
    }

    public function updateCategory($id, $name)
    {
        $sql = "UPDATE categories SET name = :name, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id, 'name' => $name]);

        $this->id = $id;
        $this->name = $name;

        return $this;
    }

    public function deleteCategory($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->conn->query($sql);
        $categories = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $category = new self();
            $category->setId($row['id']);
            $category->setName($row['name']);
            $category->setCreatedAt($row['created_at']);
            $category->setUpdatedAt($row['updated_at']);
            $categories[] = $category;
        }

        return $categories;
    }

    public function getCategoryById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row) {
            $category = new self();
            $category->setId($row['id']);
            $category->setName($row['name']);
            $category->setCreatedAt($row['created_at']);
            $category->setUpdatedAt($row['updated_at']);
            return $category;
        }

        return null;
    }

    public static function getPopularCategories()
    {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT * FROM categories LIMIT 5";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $categories = [];

        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $category = new self();
            $category->setId($row['id']);
            $category->setName($row['name']);
            $category->setCreatedAt($row['created_at']);
            $category->setUpdatedAt($row['updated_at']);
            $categories[] = $category;
        }

        return $categories;
    }
}