<?php

namespace App\Http\Controllers\Plan;
use Illuminate\Support\Facedes\DB;

use App\PlanDependence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DependenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $depen = PlanDependence::all();
        return response()->json(array(
                'plandependence'=> $depen,
                'status'=>'success'
                ), 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\PlanSource  $planSource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $depen = PlanDependence::find($id);
        if($depen != null){
                return response()->json(array(
                        'plandependence'=> $depen,
                        'status'=>'success'
                        ), 200);
        }else{
            return response()->json(array(
                        'status'=>'error'
                        ), 200);
        }    
    }
}
