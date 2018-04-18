<?php
namespace Providor;

use Providor\DB;
use Requests\Request;
use Requests\Getter;

class Helper
{

  function __construct()
  {
    return new Helper();
  }

  public static function arrayToSlicedString($array, $seperator)
  {
      $result = (string)'';
      ob_start();
      foreach(array_keys($array) as $element)
      {
         echo $result.$element.$seperator;
      }
      $output = ob_get_clean();
      $result = rtrim($output, ',');

      return $result;
  }

  public static function getPreparedStatementValues($array)
  {
      $result = (string)'';
      ob_start();
      foreach($array as $element)
      {
         echo $result.':'.$element.',';
      }
      $output = ob_get_clean();
      $result = rtrim($output, ',');

      return $result;
  }

  public static function fileLinkBuilder($file_path)
  {
    //Convert the file path format from (ex: view.home) to (view/home.php)
    $real_path = str_replace('.','/',$file_path).'.php';
    return $real_path;
  }

  public static function postRequestCatcher()
  {
      //returns a Request object
      if(!empty($_POST)) {
        $request = new Request($_POST);
        return $request;
      }
  }

  public static function getRequestCatcher()
  {
      //returns a Getter object
      if(!empty($_GET)) {
        $getter = new Getter($_GET);
        return $getter;
      }
  }
}
