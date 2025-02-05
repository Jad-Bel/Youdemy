<?php

namespace App\Controllers\Auth;

use App\Model\Auth\Auth;
use Exception;

class AuthController 
{
    private $auth;

    public function __construct () 
    {
        $this->auth = new Auth();
    }

    public function handleLogin()
    {
        require_once __DIR__ . '/../../Views/login.php';
        
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
    }
}