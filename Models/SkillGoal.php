<?php
namespace Models;
use Providor\QueryBuilder;
use Models\Score;

class SkillGoal extends Model
{
  protected $table_name = 'skill_goals';

  public $id;
  public $goal;
  public $description;
  public $skill_id;

  function __construct()
  {

  }

  public function userSkillGoal()
  {
      $userSkillGoal = SkillGoal::where();
  }


}
