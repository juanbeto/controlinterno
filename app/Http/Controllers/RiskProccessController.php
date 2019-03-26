<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RisksProcess;

class RiskProccessController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $proccess = RisksProcess::All();
        return response()->json(array(
                'proccess'=> $proccess,
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
        $proccess = new RisksProcess();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'NAME' => 'required',
                    'OBJECTIVE' => 'required',
                    'CREATEDATE' => 'required',
                    'CREATEBY' => 'required',  
                    'REVISEDBY' => 'required', 
                    'APPROVEDBY' => 'required'                   
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $proccess->name = $param->NAME;
            $proccess->objective = $param->OBJECTIVE;
            $proccess->createdate = $param->CREATEDATE;
            $proccess->createby = $param->CREATEBY;
            $proccess->revisedby = $param->REVISEDBY;
            $proccess->approvedby = $param->APPROVEDBY;
            
            $proccess->save();

            $data = array(
                'proccess' => $proccess,
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
        $procces = RisksProcess::find($id);
        if($procces != null){
                return response()->json(array(
                        'procces'=> $procces,
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
     * @param  \App\AuditPlanning  $auditPlanning
     * @return \Illuminate\Http\Response
     */
    public function edit(RisksProcess $risksProcess)
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
            'NAME' => 'required',
            'OBJECTIVE' => 'required',
            'CREATEDATE' => 'required',
            'CREATEBY' => 'required',  
            'REVISEDBY' => 'required', 
            'APPROVEDBY' => 'required' 
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $procces = AuditPlanning::where('id', $id)->update($param_array);

        $data = array(
                'planning' => $param,
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
        $procces = RisksProcess::find($id);
        $procces->delete();
        $data = array(
                'procces' => $procces,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}