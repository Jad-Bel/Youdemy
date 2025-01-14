<?php 

class auth {
    private $conn;

    public function __construct()
    {
        $this->conn = new database();
    }

    public static function isLoggedIn () 
    {
        return isset($_SESSION['user_id']);
    }

    public static function redirect ($url)
    {
        header ('location: $url');
        exit;
    }

    public static function checkRole ($role_id) {
        if ($_SESSION['role_id'] !== $role_id) {
            self::redirect('login.php');
        }
    }
}