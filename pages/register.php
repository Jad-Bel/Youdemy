<?php
require_once '../classes/Auth.php';

$auth = new Auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    try {
        $user = $auth->register($username, $email, $password, $role);
        echo "Registration successful!";
    } catch (Exception $e) {
        echo "Registration failed: " . $e->getMessage();
    }
}
?>