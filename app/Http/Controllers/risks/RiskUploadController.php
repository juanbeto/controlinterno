<?php

namespace App\Http\Controllers;
use App\RiskUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RisksUploads extends Controller
{
    //
$rutaarchivo="../storage/riskfile/";
    public function index(){

        $uploadrisks = RiskUpload::all();
        return response()->json(array(
            'upload' => $uploadrisk,
            'status'=>'success'
        ),200);
    }


public function show($id){
$uploadrisk = RiskUpload::find($id);
if($uploadrisk !=null){
    return response()->json(array(
        'uploadrisk' => $uploadrisk,
        'status' => 'success'
    ),200);
}else{
    return response()->json(array(
        'status'=>'error'
    ),200);
}
}


public function store(Request $request){
    
$json = $request->input('json',null);
$param = json_decode($json, true);
$param_array = json_decode($json, true);

$upload_risk = new RiskUpload();
$request->merge($param_array);
$validateData = \Validator::make($param_array,[
    'titulo' => 'required',
    'archivo' => 'required'

]);
if($validateData->fails())
{
    return response()->json($validateData->errors(),400);
}

$upload_risk->titulo = $param_array-> titulo;
$upload_risk->fecha_upload = date("Y-m-d H:i:s");
$upload_risk->archivo = $param_array -> archivo;
$upload_risk->save();

$data = array(
    'uploadrisk' => $upload_risk,
    'status' => 'success',
    'code' =>200
);
return response()->json($data, 200);

}



public function update($id, Request $request)
{
    $json = $request->input('json',null);
    $param = json_decode($json, true);
    $param_array = json_decode($json, true);
    
    
    $validateData = \Validator::make($param_array,[
        'titulo' => 'required',
        'archivo' => 'required'
    
    ]);
    if($validateData->fails())
    {
        return response()->json($validateData->errors(),400);
    }
    

     $uploadR = RiskUpload::where('id',$id)->update($param_array);
     

  
    
    $data = array(
        'uploadrisk' => $param,
        'status' => 'success',
        'code' =>200
    );
    return response()->json($data, 200);
    
    }


}
