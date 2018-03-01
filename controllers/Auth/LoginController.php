<?php
//CONNEXION MEMBRE
function login() {
  session_start();
  if($_SESSION['connected']) {
    header('location: index.php');
  } else {
    require 'controllers/providor.php';

    if (isset($_POST['submit'])) {

      $email = htmlspecialchars(strtolower($_POST['email']));
      $password = sha1($_POST['password']);

      if (isset($email, $password)) {

        $sql = 'SELECT * FROM users WHERE email = ? AND password =  ?';

        $statement = dbConnection($sql);
        $statement->execute(array($email, $password));
        $userexist = $statement->rowCount();

        if ($userexist == 1) {

          $userData = $statement->fetch();
          $_SESSION['id'] = $userData['id'];
          $_SESSION['nickname'] = $userData['nickname'];
          $_SESSION['email'] = $userData['email'];
          $_SESSION['connected'] = TRUE;

          header('location: index.php');

        } else {

          $formMessage = "wrong email or password!";
          header('location: login.php?formMessage=' . $formMessage);

          }

      }
    }
  }


}
