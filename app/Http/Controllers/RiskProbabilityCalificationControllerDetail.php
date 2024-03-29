<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RisksProbabilityCalificationDetail;

class RiskProbabilityCalificationControllerDetail extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      
        $califications = RisksProbabilityCalificationDetail::
            join('risk_probability_calification', 'risk_probability_calification_detail.id_probability', '=', 'risk_probability_calification.id_probability')
            ->join('risks', 'risk_probability_calification_detail.id_risks', '=', 'risks.id')
            ->select('risk_probability_calification_detail.*','risk_probability_calification.*', 'risks.*')
            ->get();                                                                   
            
           

        return response()->json(array(
                'califications'=> $califications,
                'status'=>'success'
                ), 200);
    }

    public function promedio(){
        $califications = RisksProbabilityCalificationDetail::
            join('risk_probability_calification', 'risk_probability_calification_detail.id_probability', '=', 'risk_probability_calification.id_probability')
            ->join('risks', 'risk_probability_calification_detail.id_risks', '=', 'risks.id')
            ->select('risk_probability_calification_detail.id_detail',RisksProbabilityCalificationDetail::raw('sum(risk_probability_calification_detail.valor) as promedio'),'risk_probability_calification.id_probability', 'risks.id')
            ->sum('risk_probability_calification_detail.valor');
                                                                           
            
           

        return response()->json(array(
                'califications'=> $califications,
                'status'=>'success'
                ), 200);
    }



    public function califications(){
           
        $valores = RisksProbabilityCalificationDetail::
            join('risks_factor_calification', 'risk_factor_calification_in.id_calification', '=', 'risks_factor_calification.id_calification')
            ->join('risks_factor', 'risk_factor_calification_in.id_factor', '=', 'risks_factor.id_factor')
            ->select('risk_factor_calification_in.valor','risks_factor_calification.id_user')
            ->distinct('risk_factor_calification_in.id_factor')
            ->get();
    
           // $users = DB::table('users')->distinct()->get();
    
        return response()->json(array(
                'valores'=> $valores,
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
        $calification = new RisksProbabilityCalificationDetail();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_calification' => 'required',
                    'id_factor' => 'required',
                    'valor' => 'required'
                   
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $calification->id_calification = $param->id_calification;
            $calification->id_factor = $param->id_factor;
            $calification->valor = $param->valor;
            $calification->save();

            $data = array(
                'calification' => $calification,
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
        $calification = RisksProbabilityCalificationDetail::find($id);
        if($calification != null){
                return response()->json(array(
                        'calification'=> $calification,
                        'status'=>'success'
                        ), 200);
        }else{
            return response()->json(array(
                        'status'=>'error'
                        ), 200);
        }
    }

   
    public function edit(AuditProgram $auditProgram)
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
            'id_calification' => 'required',
            'id_factor' => 'required',
            'valor' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $asignation = RisksProbabilityCalificationDetail::where('id_detail', $id)->update($param_array);

        $data = array(
                'calification' => $asignation,
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
       
        $program = RisksProbabilityCalificationDetail::find($id);
        $data = array(
                'calification' => $program,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}

