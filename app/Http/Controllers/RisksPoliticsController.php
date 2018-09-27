<?php

namespace App\Http\Controllers;

use App\RisksPolitics;
use Illuminate\Http\Request;

class RisksPoliticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $risks_politics = RisksPolitics::all();
        return response()->json(array(
                'risks_politics'=> $risks_politics,
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
        $risksPolitic = new RisksPolitics();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_risks' => 'required',
                    'description' => 'required|min:5',                    
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $risksPolitic->id_risks = $param->id_risks;
            $risksPolitic->description = $param->description;
            $risksPolitic->save();

            $data = array(
                'risksPolitic' => $risksPolitic,
                'status' => 'success',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RisksPolitics  $risksPolitics
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $risks_politic = RisksPolitics::find($id);
        if($risks != null){
                return response()->json(array(
                        'risks_politic'=> $risks_politic,
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
     * @param  \App\RisksPolitics  $risksPolitics
     * @return \Illuminate\Http\Response
     */
    public function edit(RisksPolitics $risksPolitics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RisksPolitics  $risksPolitics
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $json =  $request->input('json', null);        
        $param = json_decode($json);
        $param_array = json_decode($json, true);//Convierte en array
        $validatedData = \Validator::make($param_array, [ 
                    'id_risks' => 'required',
                    'description' => 'required|min:5',                    
        ]);            

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $risks_politic = RisksPolitics::where('id', $id)->update($param_array);

        $data = array(
                'risks_politic' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RisksPolitics  $risksPolitics
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $risks_politic = RisksPolitics::find($id);
        $risks_politic->delete();
        $data = array(
                'risks_politic' => $risks_politic,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
