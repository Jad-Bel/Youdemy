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

    public function deleteCategory($id) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
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

    public static function getPopularCategories() {
        $db = new Database();
        $conn = $db->getConnection();
        $query = "SELECT `name` FROM categories LIMIT 5";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getPaginatedCategories($page = 1, $perPage = 5)
    {
        $db = new Database();
        $conn = $db->getConnection();

        $offset = ($page - 1) * $perPage;

        $query = "SELECT * FROM categories LIMIT :limit OFFSET :offset";
        $stmt = $conn->prepare($query);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalQuery = "SELECT COUNT(*) as total FROM categories";
        $totalStmt = $conn->query($totalQuery);
        $total = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];

        $totalPages = ceil($total / $perPage);

        return [
            'categories' => $categories,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ];
    }
}
?>