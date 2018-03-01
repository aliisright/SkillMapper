<?php
//DB Connection
function dbConnection($sql) {

  require 'config/database.php';

  try {

    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $statement = $pdo->prepare($sql);

  } catch (Exception $e) {
    die('Erreur: ' . $e->getMessage());
  }
  return $statement;
}
