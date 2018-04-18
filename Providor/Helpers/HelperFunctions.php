<?php
use Providor\Helper;
use Requests\Request;
use Requests\Getter;

function render($file_path, $params = null)
{
    $real_file_path = Helper::fileLinkBuilder($file_path);
    $render = [];
    $render['view'] = include($real_file_path);
    foreach($params as $key => $value) {
      $render[$key] = $value;
    }
    return $render;
}

function post($key)
{
    $request_instance = Helper::postRequestCatcher();
    if($request_instance) { return $request_instance->input($key); }
}

function get($key)
{
    $get = Helper::getRequestCatcher();
    if($get) { return $get->getter($key); }
}

function redirectToLogin()
{
    return header('Location:login.php');
}
