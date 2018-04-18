<?php
namespace Providor;
use Providor\DB;

class QueryBuilder extends DB
{
    protected $db;
    protected $pdo;
    protected $statement;
    protected $query;
    protected $params;
    protected $class;

    function __construct($db = null)
    {
        $this->db = new DB();
        $this->pdo = $this->db->pdo;
        $this->statement = $this->db->statement;
        $this->query = $this->db->query;
        $this->params = $this->db->params;
        $this->class = $this->db->class;
    }

    public function setClassName($class_name)
    {
        $this->class = $class_name;
    }

    //For the static call from select / all ...
    public function select($table_name, $selected_fields = null)
    {
        if(isset($selected_fields)) {
          $fields = implode(',', $selected_fields);
        } else {
          $fields = '*';
        }
        $this->query = "SELECT $fields FROM $table_name";
        return $this;
    }

    public function where($field_name, $operator, $value)
    {
        if(preg_match('/WHERE/', $this->query)) {
            $query = $this->query." AND $field_name $operator :$field_name";
        } else {
            $query = $this->query." WHERE $field_name $operator :$field_name";
        }

        $this->query = $query;

        $this->params[":".$field_name] = $value;
        return $this;
    }

    public function insert($table_name, $request)
    {
        $sql_builder = QueryBuilder::sqlParamsBuilder($request);
        $sql = "INSERT INTO ".$table_name." (".$sql_builder['fields'].") VALUES(".$sql_builder['values'].")";
        $this->reqExecute($sql, $sql_builder['params']);
    }

    public function update($table_name, $request)
    {
        //The SQL update query
        ob_start();
        foreach($request as $key => $value) {
            echo $query = $key." = :".$key.",";
        }
        $output = ob_get_clean();
        $update_phrase = "UPDATE $table_name SET ".rtrim($output, ',');

        //The update parameters
        $params = [];
        foreach($request as $key => $value) {
            $params[':'.$key] = $value;
        }

        $this->params = $params;
        $this->query = $update_phrase;
        return $this;
    }

    //save the update
    public function set()
    {
        $sql = $this->query;
        $params = $this->params;
        $this->reqExecute($sql, $params);
    }

    public function destroy($table_name)
    {
      $this->query = "DELETE FROM $table_name";
      return $this;
    }

    public static function SQLBuild($sql, $params = null)
    {
        $db = new QueryBuilder();
        $db->query = $sql;
        $db->params = $params;
        $statement = $db->reqExecute($db->query, $db->params);
        return $statement;
    }

}
