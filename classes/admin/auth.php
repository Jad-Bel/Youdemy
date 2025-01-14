<?php
require_once 'Database.php';
require_once 'User.php';
require_once 'Teacher.php';
require_once 'Student.php';

class Auth {
    private $db;

    public function __construct() {
        $this->db = new Database();
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
        return $user;
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->getConnection()->prepare($sql);
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
}
?>