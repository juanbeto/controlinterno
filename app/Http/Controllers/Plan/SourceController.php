<?php

namespace App\Http\Controllers\Plan;
use Illuminate\Support\Facedes\DB;

use App\PlanSource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $source = PlanSource::all();
        return response()->json(array(
                'plansource'=> $source,
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
        $source = PlanSource::find($id);
        if($source != null){
                return response()->json(array(
                        'plansource'=> $source,
                        'status'=>'success'
                        ), 200);
        }else{
            return response()->json(array(
                        'status'=>'error'
                        ), 200);
        }    
    }
}
