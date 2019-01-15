<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminUser;
use App\Helpers\JwtAuth;

class UserController extends Controller
{
    //

    public function login(Request $request){
    	$jwt = new JwtAuth();

    	//Recibir POst
    	$json 	= request->input('json', null);
    	$param 	= json_decode($json);

    	$email = (!is_null($json) && isset($param->email))?param->email:null;
    	$password = (!is_null($json) && isset($param->password))?param->password:null;
    	$getToken = (!is_null($json) && isset($param->gettoken))?param->gettoken:true;

    	//cifrar password
    	$pwd = hash('sha256', $password);
		if(!is_null($email) && !is_null($password) && ($getToken == null || $getToken == 'false')){
			$signup = $jwt->signup($email, $pwd);
		}elsif($getToken != null){
			$signup = $jwt->signup($email, $pwd, $getToken);
			
		}else{
			$signup = response()->json(array(
										'status'=>'error',
										'message'=>'Enviar datos!'
			), 200);
		}

		return response()->json($signup, 200);
    }
}
