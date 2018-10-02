<?php

namespace App\Http\Controllers\risks;

use App\RisksControl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RisksControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $RisksControl = RisksControl::all();
        return response()->json(array(
                'risks'=> $risks,
                'status'=>'success'
                ), 200);
    }

    /**
    * Show the lists of actions associated to risks
    */
    public function indexRisks($id_risks)
    {

        $risks_control = RisksControl::where('id_risks', $id_risks)->get();
        return response()->json(array(
                'risks_control'=> $risks_control,
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
        $control = new RisksControl();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_risks' => 'required',                    
                    'id_control_type' => 'required',
                    'name' => 'required|min:5',
                    'document' => 'required',
                    'is_applied' => 'required',
                    'is_effective' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

            $control->id_risks = $param->id_risks;
            $control->id_control_type = $param->id_control_type;
            $control->name = $param->name;
            $control->document = $param->document;
            $control->is_applied = $param->is_applied;
            $control->is_effective = $param->is_effective; 
            $control->save();

            $data = array(
                'control' => $control,
                'status' => 'success',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RisksControl  $risksControl
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $control = RisksControl::find($id);
        if($control != null){
                return response()->json(array(
                        'control'=> $control,
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
     * @param  \App\RisksControl  $risksControl
     * @return \Illuminate\Http\Response
     */
    public function edit(RisksControl $risksControl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RisksControl  $risksControl
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $json =  $request->input('json', null);
        
        $param = json_decode($json);
        $param_array = json_decode($json, true);//Convierte en array
        $validatedData = \Validator::make($param_array, [ 
                    'id_risks' => 'required',                    
                    'id_control_type' => 'required',
                    'name' => 'required|min:5',
                    'document' => 'required',
                    'is_applied' => 'required',
                    'is_effective' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $control = RisksControl::where('id', $id)->update($param_array);

        $data = array(
                'action' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RisksControl  $risksControl
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $control = RisksAction::find($id);
        $control->delete();
        $data = array(
                'control' => $control,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
