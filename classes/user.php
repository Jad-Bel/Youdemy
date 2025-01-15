<?php
// require_once '../../config/database.php';

class User {
    protected $id;
    protected $username;
    protected $email;
    protected $password;
    protected $role;
    protected $created_at;
    protected $updated_at;
    protected $conn;

    public function __construct($username, $email, $password, $role) {
        $db = new Database();
        $this->conn = $db->getConnection();
        $this->username = $username;
        $this->email = $email;
        $this->password = $this->hashPassword($password);
        $this->role = $role;
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

    public function getRole() {
        return $this->role;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    protected function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    protected function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }

    public function save() {
        $sql = "INSERT INTO users (username, email, password, role, created_at, updated_at)
                VALUES (:username, :email, :password, :role, :created_at, :updated_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);
        $this->id = $this->conn->lastInsertId();
    }

    public static function findByEmail($email) {
        $conn = new database();
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->getConnection()->prepare($sql);
        $stmt->execute(['email' => $email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            $user = new User(
                $userData['username'],
                $userData['email'],
                '', 
                $userData['role']
            );
            $user->id = $userData['id'];
            $user->password = $userData['password'];
            $user->created_at = $userData['created_at'];
            $user->updated_at = $userData['updated_at'];
            return $user;
        }

        return null;
    }

    public static function verifyCredentials($email, $password) {
        $user = self::findByEmail($email);
        if ($user && $user->verifyPassword($password, $user->getPassword())) {
            return $user;
        }
        return null;
    }

    protected function getPassword() {
        return $this->password;
    }
}

// $user = User::findByEmail('john@example.com');
// if ($user) {
//     echo "User fetched successfully! Username: " . $user->getUsername() . "<br>";
// } else {
//     echo "Failed to fetch user.<br>";
// }

// $verifiedUser = User::verifyCredentials('john@example.com', 'password123');
// if ($verifiedUser) {
//     echo "Credentials verified successfully!<br>";
// } else {
//     echo "Invalid credentials.<br>";
// }
?>