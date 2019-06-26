<?php

namespace App\Http\Controllers\Plan;
use Illuminate\Support\Facedes\DB;

use App\PlanActivities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = PlanActivities::all();
        return response()->json(array(
                'activities'=> $activities,
                'status'=>'success'
                ), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Recoger datos post
        $json =  $request->input('json', null);
        $param = json_decode($json);
        $param_array = json_decode($json, true);
        //
        $activities = new PlanActivities();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_fuente' => 'required',
                    'dependence' => 'required',                    
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $activities->id_process = $param->id_process;
            $activities->id_fuente = $param->id_fuente;
            $activities->fuente = $param->fuente;
            $activities->dependence = $param->dependence;
            $activities->date_find = $param->date_find;
            $activities->description = $param->description;
            $activities->indicador = $param->indicador;
            $activities->cause = $param->cause;
            $activities->actions = $param->actions;
            $activities->type_action = $param->type_action;
            $activities->date_begin = $param->date_begin;
            $activities->date_end = $param->date_end;
            $activities->responable_c = $param->responable_c;
            $activities->responable_d = $param->responable_d;
            $activities->formulation = $param->formulation;
            $activities->concept = $param->concept;
            $activities->closed = $param->closed;
            $activities->save();

            $data = array(
                'activities' => $activities,
                'status' => 'success',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PlanActivities  $activities
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activities = PlanActivities::find($id);
        if($activities != null){
                return response()->json(array(
                        'activities'=> $activities,
                        'status'=>'success'
                        ), 200);
        }else{
            return response()->json(array(
                        'status'=>'error'
                        ), 200);
        }    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PlanActivities  $activities
     * @return \Illuminate\Http\Response
     */
    public function edit(PlanActivities $activities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlanActivities  $activities
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $json =  $request->input('json', null);
        
        $param = json_decode($json);
        $param_array = json_decode($json, true);//Convierte en array
        //$request->merge($param_array);
        //var_dump($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_fuente' => 'required',
                    'dependence' => 'required',  
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $activities = PlanActivities::where('id', $id)->update($param_array);

        $data = array(
                'activities' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlanActivities  $activities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $activities = PlanActivities::find($id);
        $activities->delete();
        $data = array(
                'activities' => $activities,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
