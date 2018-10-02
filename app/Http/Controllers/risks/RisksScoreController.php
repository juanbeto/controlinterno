<?php

namespace App\Http\Controllers\risks;

use App\RisksScore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RisksScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $risks_score = RisksScore::All();
        return response()->json(array(
                'risks_score'=> $risks_score,
                'status'=>'success'
                ), 200);
    }

    /**
    * Show the lists of actions associated to risks
    */
    public function indexRisks($id_risks)
    {

        $risks_score = RisksScore::where('id_risks', $id_risks)->get();
        return response()->json(array(
                'risks_score'=> $risks_score,
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
        $score = new RisksScore();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_risks' => 'required',                    
                    'frecuency' => 'required',
                    'impact' => 'required',
                    'score' => 'required',
                    'area' => 'required',
                    'area_desc' => 'required',
                    'valuation' => 'required',
                    'description' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $score->id_risks = $param->id_risks;
            $score->frecuency = $param->frecuency;
            $score->impact = $param->impact;
            $score->score = $param->score;            
            $score->area = $param->area;
            $score->area_desc = $param->area_desc;
            $score->valuation = $param->valuation;
            $score->description = $param->description;
            $score->save();

            $data = array(
                'score' => $score,
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
        $score = RisksScore::find($id);
        if($score != null){
                return response()->json(array(
                        'score'=> $score,
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
     * @param  \App\RisksScore  $risksScore
     * @return \Illuminate\Http\Response
     */
    public function edit(RisksScore $risksScore)
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
                    'frecuency' => 'required',
                    'impact' => 'required',
                    'score' => 'required',
                    'area' => 'required',
                    'area_desc' => 'required',
                    'valuation' => 'required',
                    'description' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $score = RisksScore::where('id', $id)->update($param_array);

        $data = array(
                'score' => $param,
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
        $score = RisksScore::find($id);
        $score->delete();
        $data = array(
                'score' => $score,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
