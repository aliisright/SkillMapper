<?php
namespace Models;
use Providor\QueryBuilder;
use Models\Skill;


class Level extends Model
{
  public $id;
  public $level;

  function __construct()
  {

  }

  public function skills()
  {
      $skills = Skill::where('level', '=', $this->level)->getAll();
      return $skills;
  }

}
