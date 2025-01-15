<?php
// require_once '../../config/database.php';

class User {
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    protected $status;
    protected $created_at;
    protected $updated_at;
    protected $conn;

    public function __construct($username, $email, $password, $role, $status = 'pending') {
        $db = new Database();
        $this->conn = $db->getConnection();
        $this->username = $username;
        $this->email = $email;
        $this->password = $this->hashPassword($password);
        $this->role = $role;
        $this->status = $status;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new Exception("Invalid email format.");
        }
    }

    public function setPassword($password) {
        $this->password = $this->hashPassword($password);
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function save() {
        $sql = "INSERT INTO users (username, email, password, role, status, created_at, updated_at)
                VALUES (:username, :email, :password, :role, :status, :created_at, :updated_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
        $this->id = $this->conn->lastInsertId();
        return true;
    }

    public static function findByEmail($email) {
        $db = new Database();
        $conn = $db->getConnection();
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }
}
?>