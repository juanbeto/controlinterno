<?php

namespace App\Http\Controllers\risks;

use App\RisksFactor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RisksFactorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $factors = RiskFactor::all()->load('RisksFactorType');
        return response()->json(array(
                'factors'=> $factors,
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
        $factor = new RiskFactor();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'name' => 'required',
                    'id_factor_type' => 'required',
                    'description' => 'required',
                    'definition' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $factor->name = $param->name;
            $factor->id_factor_type = $param->id_factor_type;
            $factor->description = $param->description;            
            $factor->definition = $param->definition;          
            $factor->save();

            $data = array(
                'factor' => $factor,
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
        $factor = RiskFactor::find($id);
        if($risfactorks != null){
                return response()->json(array(
                        'factor'=> $factor,
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
     * @param  \App\RisksFactor  $risksFactor
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
     * @param  \App\RisksFactor  $risksFactor
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
                    'id_factor_type' => 'required',
                    'description' => 'required',
                    'definition' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $factor = RiskFactor::where('id', $id)->update($param_array);

        $data = array(
                'factor' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RisksFactor  $risksFactor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $factor = RiskFactor::find($id);
        $factor->delete();
        $data = array(
                'factor' => $factor,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
