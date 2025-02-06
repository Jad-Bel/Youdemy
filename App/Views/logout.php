<?php

require_once '../vendor/autoload.php';

use App\Model\Auth\Auth;

$auth = new Auth();
$auth->logout();
?>