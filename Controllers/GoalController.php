<?php
function fetchCompletedGoals($skillId) {
  $userId = $_SESSION['id'];

  //this $sql returns the goals of this user
  $sql = "SELECT * FROM user_skillgoal
  JOIN skill_goals
  ON user_skillgoal.skillgoal_id = skill_goals.id
  WHERE user_skillgoal.user_id = ?";
  $userGoals = dbConnection($sql);
  $userGoals->execute(array($userId));

  $userGoalIds = [];
  while($userGoal = $userGoals->fetch()) {
    array_push($userGoalIds, $userGoal['id']);
  }
  //$userGoals fetches data from skill_goals
  //$userGoalIds is an array that is filled with skillgoal ids
  //this $sql returns the goals of this skill of that user
  $sql = "SELECT * FROM skill_goals
  WHERE skill_id = ? AND id IN (".implode(',',$userGoalIds).")";
  $goals = dbConnection($sql);
  $goals->execute(array($skillId));
  $goals = $goals->fetchAll(PDO::FETCH_ASSOC);
  //$goals fetches data from skill_goals
  return $goals;
}

function fetchUncompletedGoals($skillId) {
  $userId = $_SESSION['id'];

  //this $sql returns the goals of this user
  $sql = "SELECT * FROM user_skillgoal
  JOIN skill_goals
  ON user_skillgoal.skillgoal_id = skill_goals.id
  WHERE user_skillgoal.user_id = ?";
  $userGoals = dbConnection($sql);
  $userGoals->execute(array($userId));

  $userGoalIds = [];
  while($userGoal = $userGoals->fetch()) {
    array_push($userGoalIds, $userGoal['id']);
  }
  //$userGoals fetches data from skill_goals
  //$userGoalIds is an array that is filled with skillgoal ids
  //this $sql returns the goals of this skill of that user
  $sql = "SELECT * FROM skill_goals
  WHERE skill_id = ? AND id NOT IN (".implode(',',$userGoalIds).")";
  $goals = dbConnection($sql);
  $goals->execute(array($skillId));
  $goals = $goals->fetchAll(PDO::FETCH_ASSOC);
  //$goals fetches data from skill_goals
  return $goals;
}
