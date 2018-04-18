<?php
namespace Providor;
use Providor\QueryBuilder;

class RelationManager extends QueryBuilder
{
    protected $db;
    protected $pdo;
    protected $statement;
    protected $query;
    protected $params;
    protected $class;

    function __construct($db = null)
    {
        $this->db = new QueryBuilder();
        $this->pdo = $this->db->pdo;
        $this->statement = $this->db->statement;
        $this->query = $this->db->query;
        $this->params = $this->db->params;
        $this->class = $this->db->class;
    }


    public function hasMany()
    {
      
    }

}
