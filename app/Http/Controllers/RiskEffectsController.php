<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RiskEffects;

class RiskEffectsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        $riskeffects = RiskEffects::All();
        return response()->json(array(
            'effects' => $riskeffects,
            'status' => 'success'
        ),200);
    }

   


    public function indexSearch(Request $request)
    {
        //Recoger datos post
        $json =  $request->input('json', null);
        $param = json_decode($json);
        $param_array = json_decode($json, true);

        $riskseffects = RiskEffects::where($param_array)->get();
        return response()->json(array(
                'riskeffect'=> $riskseffects,
                'status'=>'success'
                ), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $effects = new RiskEffects();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'name' => 'required',
                    
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $effects->name = $param->name;
               
            $effects->save();

            $data = array(
                'effects' => $effects,
                'status' => 'success',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RisksFactor  $risksFactor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $efect = RiskEffects::find($id);
        if($efect != null){
                return response()->json(array(
                        'efect'=> $efect,
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
     * @param  \App\RisksEffects  $risksEffects
     * @return \Illuminate\Http\Response
     */
    public function edit(RisksFactor $risksFactor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RisksEffects  $risksEffects
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
                    'name' => 'required',
                   
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $efects = RisksEffects::where('id', $id)->update($param_array);

        $data = array(
                'efects' => $efects,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RisksEffects  $RisksEffects
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $efects = RisksEffects::find($id);
        $efects->delete();
        $data = array(
                'efects' => $efects,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
