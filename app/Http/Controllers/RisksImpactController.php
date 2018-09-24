<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Request;
use Illuminate\Support\Facedes\DB;
use App\RisksImpact;

class RisksImpactController extends Controller
{
	public function index(Request $request){
		$impacts = RisksImpact::all();
		return response()->json(array(
				'impacts'=> $impacts,
				'status'=>'success'
				), 200);
	}
    //
    public function register(Request $request){
    	$json = $request->input('json', null);
    	$param = json_decode($json);
    }
}
