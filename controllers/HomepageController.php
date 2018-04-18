<?php
session_start();
//Fetch the levels
$sql = "SELECT * FROM levels";
$levels = dbConnection($sql);
$levels->execute();

// Fetch the skills
$sql = "SELECT * FROM skills WHERE level = ?";
$skills = dbConnection($sql);


if(isset($_GET['validatedSkillId'])) {
  skillValidate($_GET['validatedSkillId']);
}

if(isset($_GET['deletedSkillId'])) {
  skillDelete($_GET['deletedSkillId']);
}

//Score
if(isset($_GET['addStarSkillId'], $_GET['i'])) {
  addStar($_GET['addStarSkillId'], $_GET['i']);
}

if(isset($_GET['deleteStarSkillId'], $_GET['i'])) {
  deleteStar($_GET['deleteStarSkillId'], $_GET['i']);
}

//Goals
