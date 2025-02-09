<?php

namespace App\Controllers\Auth;

use App\Model\Auth\Auth;
use Exception;

class AuthController
{
    private $auth;

    public function __construct()
    {
        $this->auth = new Auth();
    }

    public function handleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            try {
                $this->auth->login($email, $password);
                exit();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        require_once __DIR__ . '/../../Views/login.php';
    }

    public function handleRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            $auth = new Auth();
            try {
                $auth->register($username, $email, $password, $role);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        require_once __DIR__ . '/../../Views/register.php';
    }

    public function handleLogout()
    {
        $this->auth->logout();
        header('Location: login');
        exit();
    }
}
