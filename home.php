<?php
session_start();
require('Providor/AppProvidor.php');
use Models\Skill;
use Models\Level;
use Models\User;
$user = User::auth();

if($user->connected) {
  $levels = Level::all();

  



  include 'views/layouts/header.php';
  include 'views/homepage.php';
  include 'views/layouts/footer.php';
}
else {
  redirectToLogin();
}

?>
