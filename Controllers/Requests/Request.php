<?php
namespace Requests;

class Request
{
    private $request;

    function __construct($request)
    {
      //$request = $_POST
      $this->request = $request;
      foreach($this->request as $key => $value) {
        $this->request[$key] = $value;
      }
    }

    public function input($key)
    {
        return $this->request[$key];
    }

}
