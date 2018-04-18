<?php
namespace Validators;

use Requests\Request;
use Models\User;

class AuthValidator
{
    public static function register($request)
    {
        $validatedData = [];
        $validatedData['nickname'] = htmlspecialchars($request->input('nickname'));
        $validatedData['email'] = htmlspecialchars($request->input('email'));
        $validatedData['password'] = sha1($request->input('password'));
        $validatedData['password2'] = sha1($request->input('password2'));
        if(
          $validatedData['password'] == $validatedData['password2'] &&
          count(User::where('email', '=', $validatedData['email'])->getAll()) < 1
        ) {
          return $validatedData;
        }
    }

    public static function login($request)
    {
        $validatedData = [];
        $validatedData['email'] = htmlspecialchars($request->input('email'));
        $validatedData['password'] = sha1($request->input('password'));

        $authUser = User::where('email', '=', $validatedData['email'])->where('password', '=', $validatedData['password']);
        $userExists = count($authUser->getAll());
        if($userExists == 1) {
          return $authUser->first();
        }
    }

}
