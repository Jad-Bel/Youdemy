<?php
require_once '../config/database.php';
require_once '../classes/App/Auth/auth.php';

use App\Auth\Auth;


$auth = new Auth();
$auth->logout();
?>