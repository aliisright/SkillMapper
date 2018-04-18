<?php
namespace Auth;
use Requests\Request;

use Providor\Helper;
use Models\User;
use Providor\DB;

class RegisterController
{
  function __construct()
  {

  }

  public static function login(Request $request)
  {
      $validatedData = AuthValidator::register($request);

      User::save([
          'nickname' => $validatedData['username'],
          'email' => $validatedData['email'],
          'password' => $validatedData['password'],
          'created_at' => time()
      ]);
  }

}
