<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facedes\DB;

use App\RisksFrecuency;
use Illuminate\Http\Request;

class RisksFrecuencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $frecuency = RisksFrecuency::all();
        return response()->json(array(
                'frecuency'=> $frecuency,
                'status'=>'success'
                ), 200);
    }   

    public function show($id){
        $frecuency = RisksFrecuency::find($id);
        if($frecuency != null){
            return response()->json(array(
                    'frecuency'=> $frecuency,
                    'status'=>'success'
                    ), 200);
        }else{
            return response()->json(array(
                    'status'=>'error'
                    ), 200);
        }    
    }
}
