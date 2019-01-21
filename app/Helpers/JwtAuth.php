<?php
namespace App\Helpers;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\AdminUser;

class JwtAuth{
  private $key;
  private $encript_algoritm;

  function __construct(){
      $this->key = 'HJSKaquef_*12A89p';
      $this->encript_algoritm = 'HS256';
  }

  public function signup($email, $password, $getToken=null){

      $signup = false;

      $user = AdminUser::where(
        array(
          'email'=>$email,
          'password'=>$password
        )
      )->first();


      if(is_object($user)){
        $signup = true;
      }

      if($signup){
        //Generar token
        $token = array(
          'sub'   =>  $user->id,
          'email' =>  $user->email,
          'name'  =>  $user->name,
          'iat'   =>  time(),
          'exp'   =>  time() + (60*60)//Una hora de session valida
        );

        $jwt = JWT::encode($token, $this->key, $this->encript_algoritm);
        $decode = JWT::decode($jwt, $this->key, array($this->encript_algoritm));
        if(!is_null($getToken))
        {
          return $jwt;
        }else{
          return $decode;
        }

      }else{
        //devolver date_get_last_errors
        return array('status' => 'error', 'message' => 'Login ha fallado!!' );
      }
  }

  public function checkToken($jwt, $getIdentity = false){
    $auth = false;
    $decode = null;
    try{
      $decode = JWT::decode($jwt, $this->key, array($this->encript_algoritm));

    }catch(\UnexpectedValueException $e){
      $auth = false;
    }catch(\DomainException $e){
      $auth = false;
    }
    if(is_object($decode) && isset($decode->sub)){
      $auth = true;
    }else{
      $auth = false;
    }

    if($getIdentity){
      return $decode;
    }

    return $auth;
  }
}
?>
