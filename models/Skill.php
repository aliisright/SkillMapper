<?php
namespace Models;
use Providor\QueryBuilder;
use Models\UserSkill;

class Skill extends Model
{
  public $id;
  public $name;
  public $path;
  public $level;
  public $created_at;
  public $updated_at;

  function __construct()
  {

  }

  public function userSkill()
  {
      $userSkill = UserSkill::where('user_id', '=', $_SESSION['id'])->where('skill_id', '=', $this->id)->first();
      return $userSkill;
  }

}
