<?php

namespace App\Http\Controllers\risks;

use App\RisksTablescore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RisksTablescoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $risks_table = RisksTablescore::All();
        return response()->json(array(
                'risks_table'=> $risks_table,
                'status'=>'success'
                ), 200);
    }

        /**
    * Show the lists of actions associated to risks
    */
    public function indexRisks($id_risks)
    {

        $risks_table = RisksTablescore::where('id_risks', $id_risks)->get();
        return response()->json(array(
                'risks_table'=> $risks_table,
                'status'=>'success'
                ), 200);
    }

        /**
    * Show the lists of actions associated to risks
    */
    public function indexScore($id_score)
    {

        $risks_table = RisksTablescore::where('id_score', $id_score)->get();
        return response()->json(array(
                'risks_table'=> $risks_table,
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
        $risks_table = new RisksTablescore();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_risks' => 'required',                    
                    'id_score' => 'required',
                    'name_group' => 'required',
                    'frecuency' => 'required',
                    'impact' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $risks_table->id_risks = $param->id_risks;
            $risks_table->id_score = $param->id_score;
            $risks_table->name_group = $param->name_group;
            $risks_table->frecuency = $param->frecuency;            
            $risks_table->impact = $param->impact;
            $risks_table->save();

            $data = array(
                'risks_table' => $risks_table,
                'status' => 'success',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $risks_table = RisksTablescore::find($id);
        if($risks_table != null){
                return response()->json(array(
                        'risks_table'=> $risks_table,
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
     * @param  \App\RisksTablescore  $risksTablescore
     * @return \Illuminate\Http\Response
     */
    public function edit(RisksTablescore $risksTablescore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int id
     * @param  \Illuminate\Http\Request  $request
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
                    'id_risks' => 'required',                    
                    'id_score' => 'required',
                    'name_group' => 'required',
                    'frecuency' => 'required',
                    'impact' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $risks_table = RisksTablescore::where('id', $id)->update($param_array);

        $data = array(
                'risks_table' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $risks_table = RisksTablescore::find($id);
        $risks_table->delete();
        $data = array(
                'risks_table' => $risks_table,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
