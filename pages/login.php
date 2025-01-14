<?php
require_once 'classes/Auth.php';

$auth = new Auth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $auth->login($email, $password);
    if ($user) {
        echo "Login successful!";
        if ($user->getRole() === 'teacher') {
            header('Location: teacher_dashboard.php');
        } elseif ($user->getRole() === 'student') {
            header('Location: student_dashboard.php');
        }
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>