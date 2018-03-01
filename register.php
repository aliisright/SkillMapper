<?php
require 'models/User.php';
require 'controllers/Auth/RegisterController.php';
register();

include 'views/layouts/header.php';
include 'views/auth/register.php';
include 'views/layouts/footer.php';
?>
