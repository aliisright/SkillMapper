<?php
require('Providor/AppProvidor.php');
use Models\User;
use Providor\Helper;


User::register(Helper::postRequestCatcher());



//Views
include 'views/layouts/header.php';
include 'views/auth/register.php';
include 'views/layouts/footer.php';
?>
