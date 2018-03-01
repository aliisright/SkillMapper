<?php
class User {

  protected $nickname;
  protected $email;
  protected $password;
  protected $params = [];

  function __CONSTRUCT($nickname, $email, $password) {
    require 'controllers/providor.php';
    $params = [
      ':nickname' => $nickname, ':email' => $email, ':password' => $password,
    ];
    $paramKeys = implode(',', array_keys($params));

    dbConnection("INSERT INTO users (nickname, email, password) VALUES ($paramKeys)", $params);

  }


}

?>
