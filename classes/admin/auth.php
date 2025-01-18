<?php
// require_once '../user.php';

class Auth {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function register($username, $email, $password, $role) {
        if ($role === 'teacher') {
            $user = new Teacher($username, $email, $password, $role, 'pending');
        } elseif ($role === 'student') {
            $user = new Student($username, $email, $password, $role, 'pending');
        } else {
            throw new Exception("Invalid role.");
        }
    
        if ($user->save()) {
            return true;
        }
        throw new Exception("Registration failed.");
    }

    public function login($email, $password) {
        $userData = User::findByEmail($email);
        if ($userData) {
            if ($userData['status'] === 'suspended') {
                header('Location: 404.php');
                exit();
            }
    
            $user = new User($userData['username'], $userData['email'], '', $userData['role'], $userData['status']);
    
            if ($user->verifyPassword($password, $userData['password'])) {
                session_start();
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['role'] = $userData['role'];
                if ($_SESSION['role'] == 'admin') {
                    header('location: /pages/dashboard.php');
                } elseif ($_SESSION['role'] == 'student') {
                    header('location: /pages/index.php');
                } elseif ($_SESSION['role'] == 'teacher') {
                    header('location: /pages/courses.php');
                }
                return true;
            }
        }
        throw new Exception("Invalid email or password.");
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: login.php');
        exit();
    }
}
?>