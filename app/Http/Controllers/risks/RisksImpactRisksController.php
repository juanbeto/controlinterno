<?php

namespace App\Http\Controllers;

use App\RisksImpactRisks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RisksImpactRisksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impact_risks = RisksImpactRisks::all();
        return response()->json(array(
                'impact_risks'=> $impact_risks,
                'status'=>'success'
                ), 200);
    }

    
    /**
    * Show the lists of impacts associated to risks
    * @param int $id_risks
    */
    public function indexRisks($id_risks)
    {

        $impact_risks = RisksImpactRisks::where('id_risks', $id_risks)->get();
        return response()->json(array(
                'impact_risks'=> $impact_risks,
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
        $impact_risks = new RisksImpactRisks();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_risks' => 'required',
                    'id_impact' => 'required',
                    'name' => 'required|min:5'                    
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $impact_risks->id_risks = $param->id_risks;
            $impact_risks->id_impact = $param->id_impact;
            $impact_risks->name = $param->name;
            $impact_risks->save();

            $data = array(
                'impact_risks' => $impact_risks,
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
        $impact_risks = RisksImpactRisks::find($id);
        if($impact_risks != null){
                return response()->json(array(
                        'impact_risks'=> $impact_risks,
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
     * @param  \App\RisksImpactRisks  $risksImpactRisks
     * @return \Illuminate\Http\Response
     */
    public function edit(RisksImpactRisks $risksImpactRisks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
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
                    'id_impact' => 'required',
                    'name' => 'required|min:5'                 
        ]);            

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $impact_risks = RisksImpactRisks::where('id', $id)->update($param_array);

        $data = array(
                'impact_risks' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $impact_risks = RisksImpactRisks::find($id);
        $impact_risks->delete();
        $data = array(
                'impact_risks' => $impact_risks,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
