<?php
session_start();
//Fetch the levels
$sql = "SELECT * FROM levels";
$levels = dbConnection($sql);
$levels->execute();
// Fetch the skills
$sql = "SELECT * FROM skills WHERE level = ?";
$skills = dbConnection($sql);

if(isset($_GET['skillId'])) {
  skillValidate($_GET['skillId']);
}
