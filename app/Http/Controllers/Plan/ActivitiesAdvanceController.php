<?php

namespace App\Http\Controllers\Plan;
use Illuminate\Support\Facedes\DB;
use App\PlanActivitiesAdvance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivitiesAdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advance = PlanActivitiesAdvance::All();
        return response()->json(array(
                'activities_advance'=> $advance,
                'status'=>'success'
                ), 200);
    }
    
    /**
    * Show the lists of advances associated to a actvitie
    */
    public function indexActivitie($id_activitie)
    {

        $advance = PlanActivitiesAdvance::where('id_activitie', $id_risks)->get();
        return response()->json(array(
                'activities_advance'=> $advance,
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
        $advance = new PlanActivitiesAdvance();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_activitie' => 'required',                    
                    'advance' => 'required'
                    
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $advance->id_activitie = $param->id_activitie;
            $advance->advance = $param->advance;
            $advance->auditor = $param->auditor;
            $advance->observation = $param->observation;            
            $advance->save();

            $data = array(
                'advance' => $advance,
                'status' => 'success',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advance = PlanActivitiesAdvance::find($id);
        if($advance != null){
                return response()->json(array(
                        'advance'=> $advance,
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
     * @param  int $id
     * @param  \App\Request  $request
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
                    'id_activitie' => 'required',                    
                    'advance' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $advance = PlanActivitiesAdvance::where('id', $id)->update($param_array);

        $data = array(
                'advance' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @param  \App\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $advance = PlanActivitiesAdvance::find($id);
        $advance->delete();
        $data = array(
                'advance' => $advance,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
