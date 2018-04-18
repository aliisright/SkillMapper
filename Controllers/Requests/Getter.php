<?php
namespace Requests;

class Getter
{
    private $getter;

    function __construct($getter)
    {
        //$request = $_GET
        $this->getter = $getter;
        foreach($this->getter as $key => $value) {
          $this->getter[$key] = $value;
        }
    }

    public function getter($key)
    {
        return $this->getter[$key];
    }

    // public static function getUrlBuilder($url_path, $params = [])
    // {
    //     ob_start();
    //     foreach($params as $key => $value)
    //     {
    //        echo $key.'='.$value.'&';
    //     }
    //     $output = ob_get_clean();
    //     $url_arguments = '?'.rtrim($output, '&');
    //     $url = $url_path.$url_arguments;
    //
    //     return $url;
    // }

}
