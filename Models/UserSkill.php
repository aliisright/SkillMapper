<?php
namespace Models;
use Providor\QueryBuilder;
use Models\Score;

class UserSkill extends Model
{
  protected $table_name = 'user_skill';

  public $id;
  public $user_id;
  public $skill_id;
  public $state_id;
  public $score_id;
  public $created_at;
  public $updated_at;

  function __construct()
  {

  }

  public function score()
  {
      $score = Score::where('id', '=', $this->score_id)->first();
      return $score;
  }

  public function skillValidate($id) {
      $userId = $_SESSION['id'];
      $skillId = $id;
      if(!$this->isValidated($skillId)) {
        UserSkill::create([
          'state_id' => 3
        ])->where('id', '=', $skillId)->where('user_id', '=', $userId)->set();
        $this->skillUnlock($skillId);
      }
  }

  public function isValidated($id) {
      $skill = dbConnection("SELECT * FROM user_skill WHERE user_id = ? AND skill_id = ?");
      $skill->execute(array($_SESSION['id'], $id));
      $skillValidated = $skill->fetch();
      if($skillValidated['state_id'] == 3) {
        return true;
      } else {
        return false;
      }
  }

  private function skillUnlock($parentSkillId) {
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

  public function userCompletedGoals()
  {
      $sql = "SELECT * FROM user_skillgoal
              JOIN skill_goals
              ON user_skillgoal.skillgoal_id = skill_goals.id
              WHERE user_skillgoal.user_id = ?";

      $userGoals = QueryBuilder::SQLBuild($sql, $this->user_id);

      $ids = [];
      foreach($userGoals as $skillGoal) {
        $ids[] = $skillGoal->id;
      }

      $sql = "SELECT * FROM skill_goals WHERE skill_id = ? AND id IN (".implode(',',$userGoalIds).")";;

      $userGoals = QueryBuilder::SQLBuild($sql, [$this->skill_id, ]);

      return $userGoals;
  }


}
