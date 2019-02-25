<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Requests;
use App\Helpers\JwtAuth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function verifiqueAuth($request){
    	$hash = $request->header('Authorization', null);
    	$jwtAuth = new JwtAuth();
    	$checkToken = $jwtAuth->checkToken($hash);
    	if(!$checkToken){
    		return false;
    	}

    	return true;
    }
}
