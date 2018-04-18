<?php
namespace Providor;
use PDO;

class DB
{
    protected $pdo;
    protected $statement;
    protected $query;
    protected $params;
    protected $class;

    function __construct($pdo = null)
    {
        require 'config/db-conf.php';
        $this->pdo = $pdo;

        try{
          $this->pdo = new PDO("mysql:host=$host:$port;dbname=$dbName;charset=$charset", $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e){
          die('Erreur: ' . $e->getMessage());
        }
    }




    //Returns a collection (Array of objects)
    public function getAll()
    {
        $sql = $this->query;
        $params = $this->params;
        $class_name = $this->class;

        $statement = $this->reqExecute($sql, $params);
        //Fetch a collection of instances of a class

        $collection = [];
        foreach($statement->fetchAll(PDO::FETCH_ASSOC) as $instance) {
          $new_class = new $class_name();
          foreach($instance as $key => $value) {
              $new_class->setField($key, $value);
          }
          $collection[] = $new_class;
        }
        return $collection;
    }

    //Returns an object
    public function first()
    {
        $class_name = $this->class;
        $sql = $this->query;
        $params = $this->params;
        $statement = $this->reqExecute($sql, $params);

        //Fetch an instance of a class
        $new_class = new $class_name();

        foreach($statement->fetch(PDO::FETCH_ASSOC) as $key => $value) {
            $new_class->setField($key, $value);
        }
        return $new_class;
    }




    //Build parameters for Insert
    protected static function sqlParamsBuilder($request)
    {
        $fields = implode(',', array_keys($request));
        $values = Helper::getPreparedStatementValues(array_keys($request));

        $params = [];
        foreach($request as $key => $value) {
          $params[':'.$key] = $value;
        }

        $array = [
          'fields' => $fields,
          'values' => $values,
          'params' => $params
        ];
        return $array;
    }

    protected function reqExecute($sql, $params = null)
    {
        $this->params = $params;
        $statement = $this->pdo->prepare($sql);
        if(!empty($this->params)) {
          foreach ($this->params as $key => &$value) {
            $statement->bindParam($key, $value);
          }
        }
        $statement->execute();
        return $statement;
    }
}
