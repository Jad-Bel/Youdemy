<?php

class Tag
{
    private $id;
    private $name;
    private $created_at;
    private $updated_at;
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
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

    public function createTag($name)
    {
        $sql = "INSERT INTO tags (name, created_at, updated_at) VALUES (:name, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name]);
        $this->id = $this->conn->lastInsertId();
        return $this->id;
    }

    public function updateTag($id, $name)
    {
        $sql = "UPDATE tags SET name = :name, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id, 'name' => $name]);
        return $stmt->rowCount();
    }

    public function deleteTag($id)
    {
        $sql = "DELETE FROM tags WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount();
    }

    public function getAllTags()
    {
        $sql = "SELECT * FROM tags";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTagById($id)
    {
        $sql = "SELECT * FROM tags WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $tag = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tag) {
            $this->id = $tag['id'];
            $this->name = $tag['name'];
            $this->created_at = $tag['created_at'];
            $this->updated_at = $tag['updated_at'];
        }

        return $tag;
    }

    
}
?>