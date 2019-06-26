<?php

namespace App\Http\Controllers\Plan;
use Illuminate\Support\Facedes\DB;

use App\PlanProcess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $process = PlanProcess::all();
        return response()->json(array(
                'planprocess'=> $source,
                'status'=>'success'
                ), 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\PlanProcess  $planProcess
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $process = PlanProcess::find($id);
        if($process != null){
                return response()->json(array(
                        'planprocess'=> $process,
                        'status'=>'success'
                        ), 200);
        }else{
            return response()->json(array(
                        'status'=>'error'
                        ), 200);
        }    
    }
}
