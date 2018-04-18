<?php
namespace Models;

use Requests\Request;
use Validators\AuthValidator;
use Models\User;

class User extends Model
{
  public $id;
  public $nickname;
  public $email;
  public $firstName;
  public $lastName;
  public $created_at;
  public $updated_at;

  public $connected;

  function __construct()
  {

  }

  public static function register(Request $request = null)
  {
      if($request) {
        $validatedData = AuthValidator::register($request);
        User::save([
            'nickname' => $validatedData['nickname'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'created_at' => time()
        ]);

        header('Location:login.php');
      }
  }

  public static function login(Request $request = null)
  {
      if($request) {
        $validatedData = AuthValidator::login($request);

        session_start();
        $_SESSION['id'] = $validatedData->id;
        $_SESSION['nickname'] = $validatedData->nickname;
        $_SESSION['email'] = $validatedData->email;
        $_SESSION['connected'] = true;

        header('Location:home.php');
      }
  }

  public static function logout()
  {
      session_start();
      $_SESSION = array();
      session_destroy();
      header('location:login.php');
  }

  public static function auth()
  {
      $user = new User();
      if($_SESSION) {
        $user->id = $_SESSION['id'];
        $user->nickname = $_SESSION['nickname'];
        $user->email = $_SESSION['email'];
        $user->connected = $_SESSION['connected'];

        return $user;
      } else {
        return $user->connected = false;
      }
  }

}
