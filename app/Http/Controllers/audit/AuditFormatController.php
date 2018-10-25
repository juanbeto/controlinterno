<?php

namespace App\Http\Controllers\audit;

use App\AuditFormat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditFormatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $format = AuditFormat::all();
        return response()->json(array(
                'formats'=> $format,
                'status'=>'success'
                ), 200);
    }   

    public function show($id){
        $format = AuditFormat::find($id);
        if($format != null){
            return response()->json(array(
                    'format'=> $format,
                    'status'=>'success'
                    ), 200);
        }else{
            return response()->json(array(
                    'status'=>'error'
                    ), 200);
        }    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AuditQuestion  $auditQuestion
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $json =  $request->input('json', null);
        
        $param = json_decode($json);
        $param_array = json_decode($json, true);//Convierte en array
        $validatedData = \Validator::make($param_array, [ 
                    'NAME' => 'required|min:5',
                    'CODE' => 'required|min:5',
                    'VERSION' => 'required|min:1'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        unset($param_array['ID']);
        unset($param_array['FORMAT']);
        $format = AuditFormat::where('id', $id)->update($param_array);

        $data = array(
                'format' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

     /**
     * Search the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $json =  $request->input('json', null);
        $param = json_decode($json);
        $param_array = json_decode($json, true);//Convierte en array
        $formats = AuditFormat::Where("FORMAT", $param_array["FORMAT"])->get();

        if($formats != null){
                return response()->json(array(
                        'formats'=> $formats,
                        'status'=>'success'
                        ), 200);
        }else{
            return response()->json(array(
                        'status'=>'error'
                        ), 200);
        }
    }

}
