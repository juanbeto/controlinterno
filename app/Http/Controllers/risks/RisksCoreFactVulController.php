<?php

namespace App\Http\Controllers\risks;

use App\RisksCoreFact_vul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RisksCoreFactVulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $risks_fact_vul = RisksCoreFact_vul::All();
        return response()->json(array(
                'risks_fact_vul'=> $risks_fact_vul,
                'status'=>'success'
                ), 200);
    }

    /**
    * Show the lists of actions associated to risks
    */
    public function indexScore($id_score)
    {

        $risks_fact_vul = RisksCoreFact_vul::where('id_score', $id_score)->get();
        return response()->json(array(
                'risks_fact_vul'=> $risks_fact_vul,
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
        $risks_fact_vul = new RisksCoreFact_vul();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_tablescore' => 'required',                    
                    'id_vulnerabilityfactor' => 'required',
                    'id_impact' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $risks_fact_vul->id_risks = $param->id_risks;
            $risks_fact_vul->name = $param->name;
            $risks_fact_vul->owner = $param->owner;
            $risks_fact_vul->indicator = $param->indicator;            
            $risks_fact_vul->save();

            $data = array(
                'risks_fact_vul' => $risks_fact_vul,
                'status' => 'success',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RisksCoreFact_vul  $risksCoreFact_vul
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $risks_fact_vul = RisksCoreFact_vul::find($id);
        if($risks_fact_vul != null){
                return response()->json(array(
                        'risks_fact_vul'=> $risks_fact_vul,
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
     * @param  \App\RisksCoreFact_vul  $risksCoreFact_vul
     * @return \Illuminate\Http\Response
     */
    public function edit(RisksCoreFact_vul $risksCoreFact_vul)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RisksCoreFact_vul  $risksCoreFact_vul
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
                    'id_tablescore' => 'required',                    
                    'id_vulnerabilityfactor' => 'required',
                    'id_impact' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $risks_fact_vul = RisksCoreFact_vul::where('id', $id)->update($param_array);

        $data = array(
                'risks_fact_vul' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RisksCoreFact_vul  $risksCoreFact_vul
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $risks_fact_vul = RisksCoreFact_vul::find($id);
        $risks_fact_vul->delete();
        $data = array(
                'risks_fact_vul' => $risks_fact_vul,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
