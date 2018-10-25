<?php

namespace App\Http\Controllers\audit;

use App\Audit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  int $id_program
     * @return \Illuminate\Http\Response
     */
    public function index($id_program)
    {
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
                    'id_program' => 'required',
                    'name' => 'required|min:5',
                    'objective' => 'required',
                    'id_user_manager' => 'required',
                    'id_user_responsible' => 'required',                    
                    'date_begin' => 'required',
                    'date_end' => 'required',
                    'scope' => 'required',
                    'name_process' => 'required',
                    'criteria' => 'required',
                    'observations' => 'required',
                    'approved' => 'required',
                    'global' => 'required',
                    'numerals' => 'required',
                    'meci' => 'required',
                    'closed' => 'required'                    
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $audit->id_program = $param->id_program;
            $audit->name = $param->name;
            $audit->objective = $param->numerobjectiveals_iso;
            $audit->id_user_manager = $param->id_user_manager;
            $audit->id_user_responsible = $param->id_user_responsible;
            $audit->date_begin = $param->date_begin;
            $audit->date_end = $param->date_end;
            $audit->scope = $param->scope;
            $audit->name_process = $param->name_process;
            $audit->criteria = $param->criteria;
            $audit->observations = $param->observations;
            $audit->approved = $param->approved;
            $audit->global = $param->global;
            $audit->numerals = $param->numerals;
            $audit->meci = $param->meci;
            $audit->closed = $param->closed;

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
    public function show($id)
    {
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
                    'id_program' => 'required',
                    'name' => 'required|min:5',
                    'objective' => 'required',
                    'id_user_manager' => 'required',
                    'id_user_responsible' => 'required',                    
                    'date_begin' => 'required',
                    'date_end' => 'required',
                    'scope' => 'required',
                    'name_process' => 'required',
                    'criteria' => 'required',
                    'observations' => 'required',
                    'approved' => 'required',
                    'global' => 'required',
                    'numerals' => 'required',
                    'meci' => 'required',
                    'closed' => 'required'
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
