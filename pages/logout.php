<?php

require_once '../vendor/autoload.php';

use Youco\Youdemy\App\Auth\Auth;

$auth = new Auth();
$auth->logout();
?>