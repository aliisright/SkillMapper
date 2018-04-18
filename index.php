<?php
session_start();
require('Providor/AppProvidor.php');
use Models\Skill;
use Models\Level;
use Models\User;
$user = User::auth();

if($user->connected) {
  include 'views/layouts/header.php';
  // echo $_SESSION['nickname'];
  // $levels = Level::all();
  // foreach ($levels as $level) {
  //   echo $level->level;
  //   $skills = Skill::where('level', '=', $level->id)->getAll();
  //   foreach($skills as $skill) {
  //     echo $skill->name;
  //   }
  // }



  echo $user->nickname;

  include 'views/layouts/footer.php';

}
else {
  redirectToLogin();
}

?>
