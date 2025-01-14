<?php
require_once 'Database.php';

class User {
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    protected $created_at;
    protected $updated_at;
    protected $db;

    public function __construct($username, $email, $password, $role) {
        $this->db = new Database();
        $this->username = $username;
        $this->email = $email;
        $this->password = $this->hashPassword($password);
        $this->role = $role;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public function getId() {}
    public function getUsername() {}
    public function getEmail() {}
    public function getRole() {}
    public function getCreatedAt() {}
    public function getUpdatedAt() {}

    protected function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    protected function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }

    public function save() {
        $sql = "INSERT INTO users (username, email, password, role, created_at, updated_at)
                VALUES (:username, :email, :password, :role, :created_at, :updated_at)";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
        $this->id = $this->db->getConnection()->lastInsertId();
    }
}
?>