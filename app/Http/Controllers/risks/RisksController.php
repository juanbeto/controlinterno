<?php

namespace App\Http\Controllers\risks;

use App\Risks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RisksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $risks = Risks::all();
        return response()->json(array(
                'risks'=> $risks,
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
        $risks = new Risks();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'code' => 'required',
                    'id_process' => 'required',
                    'id_period' => 'required',
                    'name' => 'required|min:5',
                    'description' => 'required',
                    'effects' => 'required',
                    'causes' => 'required',
                    'classification' => 'required',
                    //'object' => 'required',
                    'factor' => 'required',
                    'factorvulnerability' => 'required',
                    'probability' => 'required',
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $risks->code = $param->code;
            $risks->id_process = $param->id_process;
            $risks->id_period = $param->id_period;
            $risks->name = $param->name;
            $risks->description = $param->description;
            $risks->effects = $param->effects;
            $risks->causes = $param->causes;
            $risks->classification = $param->classification;
            $risks->object = $param->object;
            $risks->factor = $param->factor;
            $risks->factorvulnerability = $param->factorvulnerability;
            $risks->probability = $param->probability;
            $risks->createdate = date("Y-m-d H:i:s");
            $risks->save();

            $data = array(
                'risk' => $risks,
                'status' => 'success',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Risks  $risks
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $risks = Risks::find($id);
        if($risks != null){
                return response()->json(array(
                        'risks'=> $risks,
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
     * @param  \App\Risks  $risks
     * @return \Illuminate\Http\Response
     */
    public function edit(Risks $risks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Risks  $risks
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
                    'code' => 'required',
                    'id_process' => 'required',
                    'id_period' => 'required',
                    'name' => 'required|min:5',
                    'description' => 'required',
                    'effects' => 'required',
                    'causes' => 'required',
                    'classification' => 'required',
                    //'object' => 'required',
                    'factor' => 'required',
                    'factorvulnerability' => 'required',
                    'probability' => 'required',
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $risk = Risks::where('id', $id)->update($param_array);

        $data = array(
                'risk' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Risks  $risks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $risk = Risks::find($id);
        $risk->delete();
        $data = array(
                'risk' => $risk,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
