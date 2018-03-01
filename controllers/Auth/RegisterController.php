<?php
function register() {
  require 'controllers/providor.php';
  if(isset($_POST['submit'])) {

    if(isset($_POST['nickname'], $_POST['email'], $_POST['password'], $_POST['password2'])) {
      $nickname = htmlspecialchars($_POST['nickname']);
      $email = htmlspecialchars($_POST['email']);
      $password = sha1($_POST['password']);
      $password2 = sha1($_POST['password2']);

      if(strlen($nickname) <= 15) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
          if(strlen($_POST['password'] >= 6)) {
            if($password == $password2) {
              //Verify if the mail is already taken
              $sql = 'SELECT * FROM users WHERE email = ?';
                $request = dbConnection($sql);
                $request->execute(array($email));
                $emailExists = $request->rowCount();

              if($emailExists == 0) {
                //Verify if the mail is already taken
                $sql = 'SELECT * FROM users WHERE nickname = ?';
                  $request = dbConnection($sql);
                  $request->execute(array($nickname));
                  $nicknameExists = $request->rowCount();

                if($nicknameExists == 0) {
                  //User creation
                  $sql = 'INSERT INTO users (nickname, password, email) VALUES (?, ?, ?)';

                  $statement = dbConnection($sql);

                  $statement->execute(array($nickname, $password, $email));

                  $successMessage = "Utilisateur créé!";
                } else {
                  //Nickname exist
                  $formMessage = "Pseudo déjà pris!";
                }
              } else {
                //Email exist
                $formMessage = "Email déjà pris!";
              }
            } else {
              //2 passwords don't match
              $formMessage = "Les mots de passe ne correspondent pas!";
            }
          } else {
            //password length
            $formMessage = "Le mot de passe doit avoir au moins 6 caractèers";
          }
        } else {
          //email form validation
          $formMessage = "Le format du email n'est pas valide";
        }
      } else {
        //nickname length
        $formMessage = "Pseudo est trop long; il ne doit pas dépasser 15 caractères!";
      }
    }
    header('Location: register.php?formMessage='.$formMessage.'&successMessage='.$successMessage);
  }
}
