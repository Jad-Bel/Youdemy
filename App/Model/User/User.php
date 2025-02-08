<?php

namespace App\Model\User;

use App\Core\Database\Database;

class User
{
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    protected $status;
    protected $created_at;
    protected $updated_at;
    protected $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new \Exception("Invalid email format.");
        }
    }

    public function setPassword($password)
    {
        $this->password = $this->hashPassword($password);
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    // Save method
    public function save()
    {
        $checkEmailSql = "SELECT id FROM users WHERE email = :email";
        $checkEmailStmt = $this->conn->prepare($checkEmailSql);
        $checkEmailStmt->execute(['email' => $this->email]);
        $existingUser = $checkEmailStmt->fetch(\PDO::FETCH_ASSOC);

        if ($existingUser) {
            header('location: register.php');
            exit();
        }

        $sql = "INSERT INTO users (username, email, password, role, status, created_at, updated_at)
                VALUES (:username, :email, :password, :role, :status, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'status' => $this->status,
        ]);
        $this->id = $this->conn->lastInsertId();
        return true;
    }

    // Static methods
    public static function findByEmail($email)
    {
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getAllUsers($currentUser)
    {
        if ($currentUser->getRole() == 'admin') {
            $db = new Database();
            $conn = $db->getConnection();
            $stmt = $conn->query("SELECT * FROM users");
            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        }
        return [];
    }

    public static function getAllTeachers($currentUser)
    {
        if ($currentUser->getRole() == 'admin') {
            $db = new Database();
            $conn = $db->getConnection();
            $stmt = $conn->query("SELECT * FROM users WHERE role = 'teacher'");
            $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        }
        return [];
    }

    // Helper methods
    protected function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
}