<?php

namespace App\Model\Auth;

use App\Core\Database\Database;
use App\Model\User\User;
use App\Model\Teacher\Teacher;
use App\Model\Student\Student;


class Auth {
    private $conn;

    public function __construct() {
        $db = new database();
        $this->conn = $db->getConnection();
    }

    public function register($username, $email, $password, $role)
    {
        if ($role === 'teacher') {
            $user = new Teacher();
        } elseif ($role === 'student') {
            $user = new Student();
        } else {
            throw new \Exception("Invalid role.");
        }
    
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setRole($role);
        $user->setStatus('pending');
    
        if ($user->save()) {
            return true;
        }
        throw new \Exception("Registration failed.");
    }

    public function login($email, $password) {
        $userData = User::findByEmail($email);
        if ($userData) {
            if ($userData['status'] === 'suspended') {
                header('Location: 404.php');
                exit();
            }
    
            $user = new User();
            $user->setId($userData['id']);
            $user->setUsername($userData['username']);
            $user->setEmail($userData['email']);
            $user->setRole($userData['role']);
            $user->setStatus($userData['status']);
    
            if ($user->verifyPassword($password, $userData['password'])) {
                session_start();
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['role'] = $userData['role'];
                if ($_SESSION['role'] == 'admin') {
                    header('location: admin');
                } elseif ($_SESSION['role'] == 'student') {
                    header('location: Student');
                } elseif ($_SESSION['role'] == 'teacher') {
                    header('location: teacher');
                }
                return true;
            }
        }
        throw new \Exception("Invalid email or password.");
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
    }
}