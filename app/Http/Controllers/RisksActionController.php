<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facedes\DB;
use App\RisksAction;
use Illuminate\Http\Request;

class RisksActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $risks_actions = RisksAction::All();
        return response()->json(array(
                'risks_actions'=> $risks_actions,
                'status'=>'success'
                ), 200);
    }

    public function indexRisks($id_risks)
    {

        $risks_actions = RisksAction::where('id_risks', $id_risks)->get();
        return response()->json(array(
                'risks_actions'=> $risks_actions,
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
        $action = new RisksAction();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_risks' => 'required',                    
                    'name' => 'required|min:5',
                    'owner' => 'required',
                    'indicator' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $action->id_risks = $param->id_risks;
            $action->name = $param->name;
            $action->owner = $param->owner;
            $action->indicator = $param->indicator;            
            $action->save();

            $data = array(
                'action' => $action,
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
        $action = RisksAction::find($id);
        if($risks != null){
                return response()->json(array(
                        'action'=> $action,
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
                    'id_risks' => 'required',                    
                    'name' => 'required|min:5',
                    'owner' => 'required',
                    'indicator' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $action = RisksAction::where('id', $id)->update($param_array);

        $data = array(
                'action' => $param,
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
        $action = RisksAction::find($id);
        $action->delete();
        $data = array(
                'action' => $action,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
