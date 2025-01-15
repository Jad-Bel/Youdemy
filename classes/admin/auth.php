<?php
// require_once '../../config/database.php';
// require_once 'user.php';
// require_once '../teacher.php';
// require_once '../student.php';

class Auth {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function register($username, $email, $password, $role) {
        if ($role === 'teacher') {
            $user = new Teacher($username, $email, $password);
        } elseif ($role === 'student') {
            $user = new Student($username, $email, $password);
        } else {
            throw new Exception("Invalid role.");
        }

        $user->save();
        header('location: login.php');
        return true;
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData && $this->verifyPassword($password, $userData['password'])) {
            if ($userData['role'] === 'teacher') {
                $user = new Teacher($userData['username'], $userData['email'], $userData['password']);
            } elseif ($userData['role'] === 'student') {
                $user = new Student($userData['username'], $userData['email'], $userData['password']);
            } else {
                throw new Exception("Invalid role.");
            }

            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['role'] = $userData['role'];
            $_SESSION['username'] = $userData['username'];

            return $user;
        }

        return null;
    }

    public function logout() {
        session_destroy();
        header('Location: login.php');
        exit();
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    private function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }

    public function getUserRole() {
        return $_SESSION['role'] ?? null;
    }

    public function getUserId() {
        return $_SESSION['user_id'] ?? null;
    }

    public function getUsername() {
        return $_SESSION['username'] ?? null;
    }
}
?>