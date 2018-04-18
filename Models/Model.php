<?php
namespace Models;

use Providor\Helper;
use Providor\DB;
use Providor\QueryBuilder;

class Model
{
    public function id()
    {
        return $this->id;
    }

    public function field($field_name)
    {
        return $this->$field_name;
    }

    public function setField($field_name, $value)
    {
        $this->$field_name = $value;
    }

    //Save instance in the database
    public static function save($request)
    {
        //Getting table name of the calling class
        $table_name = Self::getTableNameStaticCall();
        $class_name = get_called_class();
        $db = new QueryBuilder();
        $db->setClassName($class_name);
        $sql_builder = $db->insert($table_name, $request);
    }

    public static function update($request)
    {
        //Getting table name of the calling class
        $table_name = Self::getTableNameStaticCall();
        $class_name = get_called_class();
        $db = new QueryBuilder();
        $db->setClassName($class_name);
        $sql_builder = $db->update($table_name, $request);
        return $sql_builder;
    }

    //search by Id and fetch one result
    public static function find($id)
    {
        $table_name = Self::getTableNameStaticCall();
        $class_name = get_called_class();
        $db = new QueryBuilder();
        $db->setClassName($class_name);
        $results = $db->select($table_name)->where('id', '=', $id)->first();
        return $results;
    }

    public function destroy()
    {
        $table_name = $this->getTableName();
        $id = $this->id;
        $db = new QueryBuilder();
        $db->setClassName($class_name);
        $results = $db->destroy($table_name)->where('id', '=', $id)->set();
        return $results;
    }

    public static function select($selected_fields = [])
    {
        $table_name = Self::getTableNameStaticCall();
        $class_name = get_called_class();
        $db = new QueryBuilder();
        $db->setClassName($class_name);
        $results = $db->select($table_name, $selected_fields);
        return $results;
    }

    public static function all()
    {
        $table_name = Self::getTableNameStaticCall();
        $class_name = get_called_class();
        $db = new QueryBuilder();
        $db->setClassName($class_name);
        $results = $db->select($table_name)->getAll();
        return $results;
    }

    public static function first()
    {
        $table_name = Self::getTableNameStaticCall();
        $class_name = get_called_class();
        $db = new QueryBuilder();
        $db->setClassName($class_name);
        $results = $db->select($table_name)->first();
        return $results;
    }

    public static function where($field_name, $operator, $value)
    {
        $table_name = Self::getTableNameStaticCall();
        $class_name = get_called_class();
        $db = new QueryBuilder();
        $db->setClassName($class_name);
        $results = $db->select($table_name)->where($field_name, $operator, $value);
        return $results;
    }






    //class and table names getters
    public function getClassName()
    {
        return (substr(get_class($this), strrpos(get_class($this), '\\') + 1));
    }

    public static function getClassNameStaticCall()
    {
        return (substr(get_called_class(), strrpos(get_called_class(), '\\') + 1));
    }

    public function getTableName()
    {
        return lcfirst(substr(get_class($this), strrpos(get_class($this), '\\') + 1)).'s';
    }

    public static function getTableNameStaticCall()
    {
        $class_name = get_called_class();
        $instance = new $class_name();
        if(isset($instance->table_name)) {
          //custom table name
          $table_name = $instance->table_name;
        } else {
          //conventional table name
          $table_name = lcfirst(substr(get_called_class(), strrpos(get_called_class(), '\\') + 1)).'s';
        }
        return $table_name;
    }

}
