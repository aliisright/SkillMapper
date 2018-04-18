<?php
namespace Providor;

class Router
{
    private $uri= [];

    public function add($uri)
    {
        $this->uri[] = '/'.trim($uri, '/');
    }

    public function submit()
    {
        $uriGet = (isset($_GET['uri'])) ? $_GET['uri'] : '/';

        foreach ($this->uri as $key => $value) {
          if(preg_match("#^$value$#", $uriGet)) {
            var_dump($uriGet);
            var_dump($value);
            echo "match!<br/>";
          }
        }
    }
}
