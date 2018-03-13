<?php
session_start();
//Fetch the levels
$sql = "SELECT * FROM levels";
$levels = dbConnection($sql);
$levels->execute();

// Fetch the skills
$sql = "SELECT * FROM skills WHERE level = ?";
$skills = dbConnection($sql);

//Fetch the skill class
$skillClassSql = "SELECT * FROM user_skill WHERE user_id = ? AND skill_id = ?";
$skillClassStatement = dbConnection($skillClassSql);

$childSkillsSql = "SELECT * FROM parentskill_childskill
JOIN skills
ON parentskill_childskill.childskill_id = skills.id
WHERE parentskill_id = ?";
$childSkills = dbConnection($childSkillsSql);

if(isset($_GET['validatedSkillId'])) {
  skillValidate($_GET['validatedSkillId']);
}

if(isset($_GET['deletedSkillId'])) {
  skillDelete($_GET['deletedSkillId']);
}
