<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\Http\Request;
use Illuminate\Support\Facedes\DB;
use App\RisksImpact;

class RisksImpactController extends Controller
{
	public function index(){
		$impacts = RisksImpact::all();
		return response()->json(array(
				'impacts'=> $impacts,
				'status'=>'success'
				), 200);
	}
    //
    public function show($id){
    	$impact = RisksImpact::find($id);
    	if($impact != null){
	    	return response()->json(array(
					'impact'=> $impact,
					'status'=>'success'
					), 200);
    	}else{
    		return response()->json(array(
					'status'=>'error'
					), 200);
    	}    
    }
}
