<?php
require_once '../config/database.php';
require_once '../classes/admin/auth.php';


$auth = new Auth();
$auth->logout();
?>