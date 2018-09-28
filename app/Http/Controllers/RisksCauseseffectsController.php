<?php

namespace App\Http\Controllers;

use App\RisksCauseseffects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RisksCauseseffectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $causes = RisksCauseseffects::All();
        return response()->json(array(
                'causes_effects'=> $causes,
                'status'=>'success'
                ), 200);
    }

    public function indexRisks($id_risks)
    {

        $causes = RisksCauseseffects::where('id_risks', $id_risks)->get();
        return response()->json(array(
                'causes_effects'=> $causes,
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
        $causes = new RisksCauseseffects();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_risks' => 'required',                    
                    'causes' => 'required|min:5',
                    'effects' => 'required|min:5'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $causes->id_risks = $param->id_risks;
        $causes->causes = $param->causes;
        $causes->effects = $param->effects;         
        $causes->save();

        $data = array(
            'causes_effects' => $causes,
            'status' => 'success',
            'code' => 200
        );

        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $causes = RisksCauseseffects::find($id);
        if($causes != null){
                return response()->json(array(
                        'causes_effects'=> $causes,
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
     * @param  \App\RisksCauseseffects  $risksCauseseffects
     * @return \Illuminate\Http\Response
     */
    public function edit(RisksCauseseffects $risksCauseseffects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  \App\Request  $request
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
                    'id_risks' => 'required',                    
                    'causes' => 'required|min:5',
                    'effects' => 'required|min:5'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $causes = RisksCauseseffects::where('id', $id)->update($param_array);

        $data = array(
                'causes_effects' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $causes = RisksCauseseffects::find($id);
        $action->delete();
        $data = array(
                'causes_effects' => $causes,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
