<?php
function skillUnlock($parentSkillId) {
  $userId = $_SESSION['id'];

  $childSkillsSql = "SELECT * FROM parentskill_childskill
  JOIN skills
  ON parentskill_childskill.childskill_id = skills.id
  WHERE parentskill_id = ?";
  $childSkills = dbConnection($childSkillsSql);
  $childSkills->execute(array($parentSkillId));

  while($childSkill = $childSkills->fetch()) {
    $sql = "UPDATE user_skill SET state_id = ? WHERE skill_id = ? AND user_id = ?";
    $childSkillState = dbConnection($sql);
    $childSkillState->execute(array(2, $childSkill['id'], $userId));
  }
}

function skillLock($parentSkillId) {
  $userId = $_SESSION['id'];

  $childSkillsSql = "SELECT * FROM parentskill_childskill
  JOIN skills
  ON parentskill_childskill.childskill_id = skills.id
  WHERE parentskill_id = ?";
  $childSkills = dbConnection($childSkillsSql);
  $childSkills->execute(array($parentSkillId));

  while($childSkill = $childSkills->fetch()) {
    $sql = "UPDATE user_skill SET state_id = ? WHERE skill_id = ? AND user_id = ?";
    $childSkillState = dbConnection($sql);
    $childSkillState->execute(array(1, $childSkill['id'], $userId));
  }
}

function skillValidate($id) {
  $userId = $_SESSION['id'];
  $skillId = $id;

  if(!isValidated($skillId)) {
    $sql = "UPDATE user_skill SET state_id = ? WHERE skill_id = ? AND user_id = ?";
    $skill = dbConnection($sql);
    $skill->execute(array(3, $skillId, $userId));

    skillUnlock($skillId);
  }
}

function skillDelete($id) {
  $userId = $_SESSION['id'];
  $skillId = $id;
  if(isValidated($skillId)) {
    $sql = "UPDATE user_skill SET state_id = ? WHERE user_id = ? AND skill_id = ?";
    $skill = dbConnection($sql);
    $skill->execute(array(2, $userId, $skillId));

    skillLock($skillId);
  }
}

function isValidated($id) {
  $skill = dbConnection("SELECT * FROM user_skill WHERE user_id = ? AND skill_id = ?");
  $skill->execute(array($_SESSION['id'], $id));
  $skillValidated = $skill->fetch();
  if($skillValidated['state_id'] == 3) {
    return true;
  } else {
    return false;
  }
}
