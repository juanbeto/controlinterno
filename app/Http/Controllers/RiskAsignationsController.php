<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\risk_factor_asignation;

class RiskAsignationsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      
        $asignations = risk_factor_asignation::
            join('risks_process', 'risk_factor_asignation.id_proccess', '=', 'risks_process.id_proccess')
            ->join('risks_factor', 'risk_factor_asignation.id_factor', '=', 'risks_factor.id_factor')
            ->select('risks_process.*', 'risks_factor.*')
            ->get();



        return response()->json(array(
                'asignations'=> $asignations,
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
        $asignation = new risk_factor_asignation();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_proccess' => 'required',
                    'id_factor' => 'required',
                   
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $asignation->id_proccess = $param->id_proccess;
            $asignation->id_factor = $param->id_factor;
            $asignation->save();

            $data = array(
                'asignation' => $asignation,
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
        $asignation = risk_factor_asignation::find($id);
        if($asignation != null){
                return response()->json(array(
                        'asignation'=> $asignation,
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
            'id_proccess' => 'required',
            'id_factor' => 'required',
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $asignation = risk_factor_asignation::where('id_asignation', $id)->update($param_array);

        $data = array(
                'asignation' => $param,
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
       
        $program = risk_factor_asignation::find($id);
        $data = array(
                'asignation' => $program,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
