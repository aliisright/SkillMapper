<?php
function skillValidate($id) {
  $userId = $_SESSION['id'];
  $skillId = $id;

  if(!isValidated($id)) {
    $sql = "INSERT INTO user_skill (user_id, skill_id) VALUES (?, ?)";
    $skill = dbConnection($sql);
    $skill->execute(array($userId, $skillId));
  } else {
    header('Location: index.php');
  }
}

function skillDelete($id) {
  $userId = $_SESSION['id'];
  $skillId = $id;
  $sql = "DELETE FROM user_skill WHERE 'user_id' = ? AND 'skill_id' = ?";
  $skill = dbConnection($sql);
  $skill->execute(array($userId, $skillId));

  header('Location: index.php');
}

function isValidated($id) {
  $skill = dbConnection("SELECT * FROM user_skill WHERE user_id = ? AND skill_id = ?");
  $skill->execute(array($_SESSION['id'], $id));
  $skillValidated = $skill->rowCount();
  if($skillValidated == 0) {
    return false;
  } elseif($skillValidated > 0) {
    return true;
  }
}
