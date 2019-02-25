<?php

namespace App\Http\Controllers\audit;

use App\Audit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\JwtAuth;


class AuditController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param  int $id_program
     * @return \Illuminate\Http\Response
     */
    public function index($id_program, Request $request)
    {

        $this->verifiqueAuth($request);
        $audits = Audit::where('id_program', $id_program)->get();
        return response()->json(array(
                'audits'=> $audits,
                'status'=>'success'
                ), 200);
    }

     /**
     * Display a listing of the resource.
     * @param  int $id_program
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Request $request)
    {
        //Recoger datos post
        $json =  $request->input('json', null);
        $param = json_decode($json);
        $param_array = json_decode($json, true);

        $audits = Audit::where($param_array)->get();
        return response()->json(array(
                'audits'=> $audits,
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
        $audit = new Audit();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'ID_PROGRAM' => 'required',
                    'NAME' => 'required|min:5',
                    'OBJECTIVE' => 'required',
                    //'ID_USER_MANAGER' => 'required',
                    //'ID_USER_RESPONSIBLE' => 'required',                    
                    'DATE_BEGIN' => 'required',
                    'DATE_END' => 'required',
                    'SCOPE' => 'required',
                    'NAME_PROCESS' => 'required',
                    'CRITERIA' => 'required',
                    'OBSERVATIONS' => 'required'
                    //'APPROVED' => 'required',
                    //'GLOBAL' => 'required',
                    //'NUMERALS' => 'required',
                    //'MECI' => 'required',
                    //'CLOSED' => 'required'                    
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $audit->id_program = $param->ID_PROGRAM;
            $audit->name = $param->NAME;
            $audit->objective = $param->OBJECTIVE;
            $audit->id_user_manager = $param->ID_USER_MANAGER;
            $audit->id_user_responsible = $param->ID_USER_RESPONSIBLE;
            $audit->date_begin = $param->DATE_BEGIN;
            $audit->date_end = $param->DATE_END;
            $audit->scope = $param->SCOPE;
            $audit->name_process = $param->NAME_PROCESS;
            $audit->criteria = $param->CRITERIA;
            $audit->observations = $param->OBSERVATIONS;
            $audit->approved = $param->APPROVED;
            $audit->global = $param->GLOBAL;
            $audit->numerals = $param->NUMERALS;
            $audit->meci = $param->MECI;
            $audit->closed = $param->CLOSED;

            $audit->save();

            $data = array(
                'audit' => $audit,
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
    public function show($id, Request $request)
    {

        $vali = $this->verifiqueAuth($request);
        if($vali){
            $audit = Audit::find($id);
            if($audit != null){
                    return response()->json(array(
                            'audit'=> $audit,
                            'status'=>'success'
                            ), 200);
            }else{
                return response()->json(array(
                            'status'=>'error'
                            ), 200);
            }  
        }else{
            return response()->json(array(
                            'status'=>'error_authorization',
                            'message'=>'error Authorization'
                            ), 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function edit(Audit $audit)
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
                    'ID_PROGRAM' => 'required',
                    'NAME' => 'required|min:5',
                    'OBJECTIVE' => 'required',
                    //'ID_USER_MANAGER' => 'required',
                    //'ID_USER_RESPONSIBLE' => 'required',                    
                    'DATE_BEGIN' => 'required',
                    'DATE_END' => 'required',
                    'SCOPE' => 'required',
                    'NAME_PROCESS' => 'required',
                    'CRITERIA' => 'required',
                    'OBSERVATIONS' => 'required'
                    //'APPROVED' => 'required',
                    //'GLOBAL' => 'required',
                    //'NUMERALS' => 'required',
                    //'MECI' => 'required',
                    //'CLOSED' => 'required'   
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $audit = Audit::where('id', $id)->update($param_array);

        $data = array(
                'audit' => $param,
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
        $audit = Audit::find($id);
        $audit->delete();
        $data = array(
                'audit' => $audit,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
