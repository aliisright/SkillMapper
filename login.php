<?php
require('Providor/AppProvidor.php');
use Models\User;
use Providor\Helper;

User::login(Helper::postRequestCatcher());

include 'views/layouts/header.php';
include 'views/auth/login.php';
include 'views/layouts/footer.php';
?>
