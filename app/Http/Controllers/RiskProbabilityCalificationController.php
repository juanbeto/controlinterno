<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RisksProbabilityCalification;

class RiskProbabilityCalificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

public function index(){

  
    $probabilityCalifications = RisksProbabilityCalification::All();
    return response()->json(array(
        'probabilityCalifications' => $probabilityCalifications,
        'status' => 'success'
    ),200);

   
}


   public function usuarios(){

    $usuarios =RisksProbabilityCalification::select('id_user')
    ->get();

   
       return response()->json(array(
        'usuarios' => $usuarios,
        'status' => 'success'
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
        $probability = new RisksProbabilityCalification();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'ID_USER' => 'required',
                    'DATE' => 'required'
                                     
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $probability->id_user = $param->ID_USER;
            $probability->date = $param->date("Y-m-d H:i:s");
            
            
            $probability->save();

            $data = array(
                'probability' => $probability,
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
        $probabilitycalification = RisksProbabilityCalification::find($id);
        if($probabilitycalification != null){
                return response()->json(array(
                        'probabilitycalification'=> $probabilitycalification,
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
     * @param  \App\risksCalification  $auditPlanning
     * @return \Illuminate\Http\Response
     */
    public function edit(RisksProcess $risksProcess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $json =  $request->input('json', null);
        
        $param = json_decode($json);
        $param_array = json_decode($json, true);//Convierte en array
        $validatedData = \Validator::make($param_array, [
            'ID_USER' => 'required',
            'DATE' => 'required',
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $procces = RisksProbabilityCalification::where('id', $id)->update($param_array);

        $data = array(
                'probabilitycalification' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $procces = RisksProbabilityCalification::find($id);
        $procces->delete();
        $data = array(
                'probabilitycalification' => $procces,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
