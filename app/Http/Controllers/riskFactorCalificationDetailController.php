<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\riskCalificationDetail;
use Illuminate\Support\Facades\DB;


class riskFactorCalificationDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $califications = riskCalificationDetail::
            join('risks_factor_calification', 'risk_factor_calification_in.id_calification', '=', 'risks_factor_calification.id_calification')
            ->join('risks_factor', 'risk_factor_calification_in.id_factor', '=', 'risks_factor.id_factor')
            ->select('risk_factor_calification_in.*','risks_factor_calification.*', 'risks_factor.*')
            ->distinct('risk_factor.NAME')
            ->get();



        return response()->json(array(
                'califications'=> $califications,
                'status'=>'success'
                ), 200);
    }

    PUBLIC FUNCTION getAvgByFactor($id, Request $request){

          $valor =  riskCalificationDetail::where( 'id_factor', $id )
	       ->groupBy( 'id_factor' )
	         ->select( 'id_factor', DB::raw( ' ROUND(AVG(valor)) promedio' ) ) //round
	           ->get();

             return response()->json(array(
                     'avg'=> $valor,
                     'status'=>'success'
                     ), 200);
    }

    public function califications(){

        $valores = riskCalificationDetail::
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
        $calification = new riskCalificationDetail();
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
        $calification = riskCalificationDetail::find($id);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AuditProgram  $auditProgram
     * @return \Illuminate\Http\Response
     */
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

        $asignation = riskCalificationDetail::where('id_calification_in', $id)->update($param_array);

        $data = array(
                'calification' => $param,
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

        $program = riskCalificationDetail::find($id);
        $data = array(
                'calification' => $program,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
