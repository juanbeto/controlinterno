<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RiskEffectsCause;

class RiskEffectsCauseController extends Controller
{
    



 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      
        $riskEffectsCause = RiskEffectsCause::
            join('risks', 'risks.id', '=', 'risks_effectscause.id_risks')
            ->join('risks_effects', 'risks_effects.id_effects', '=', 'risks_effectscause.id_effects')
            ->select('risks_effectscause.*','risks.id','risks_effects.*')
            ->get();

           

        return response()->json(array(
                'riskEffectsCause'=> $riskEffectsCause,
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
        $riskeffectcause = new RiskEffectsCause();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_risks' => 'required',
                    'id_effects' => 'required'
                    
                   
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $riskeffectcause->id_risks = $param->id_risks;
            $riskeffectcause->id_effects = $param->id_effects;
            $riskeffectcause->save();

            $data = array(
                'riskeffectcause' => $riskeffectcause,
                'status' => 'success',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $riskeffectcause = RiskEffectsCause::find($id);
        if($riskeffectcause != null){
                return response()->json(array(
                        'riskeffectcause'=> $riskeffectcause,
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
     * @param  \App\AuditProgram  $auditProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditProgram $auditProgram)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $json =  $request->input('json', null);
        
        $param = json_decode($json);
        $param_array = json_decode($json, true);//Convierte en array
        $validatedData = \Validator::make($param_array, [ 
            'id_risks' => 'required',
            'id_effects' => 'required',
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $asignation = RiskEffectsCause::where('id', $id)->update($param_array);

        $data = array(
                'riskeffectcause' => $asignation,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
       
        $program = RiskEffectsCause::find($id);
        $data = array(
                'riskeffectcause' => $program,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
