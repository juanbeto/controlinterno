<?php

namespace App\Http\Controllers\audit;

use App\AuditProgram;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = AuditProgram::Where('is_delete', '0')->get();
        return response()->json(array(
                'programs'=> $programs,
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
        $program = new AuditProgram();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'begin' => 'required',
                    'end' => 'required',
                    'objectives' => 'required',
                    'scope' => 'required',
                    'resposabilities' => 'required',                    
                    'approved' => 'required|in:0,1',
                    'resources' => 'required',
                    'observation' => 'required',
                    'enable' => 'required|in:0,1',
                    'delete' => 'required|in:0,1'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $program->begin = $param->begin;
            $program->end = $param->end;
            $program->objectives = $param->objectives;
            $program->scope = $param->scope;
            $program->resposabilities = $param->resposabilities;
            $program->approved = $param->approved;
            $program->resources = $param->resources;
            $program->observation = $param->observation;
            $program->enable = $param->enable;
            $program->delete = $param->delete;  
            $program->save();

            $data = array(
                'program' => $program,
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
        $program = AuditProgram::find($id);
        if($program != null){
                return response()->json(array(
                        'program'=> $program,
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
                    'begin' => 'required',
                    'end' => 'required',
                    'objectives' => 'required',
                    'scope' => 'required',
                    'resposabilities' => 'required',                    
                    'approved' => 'required|in:0,1',
                    'resources' => 'required',
                    'observation' => 'required',
                    'enable' => 'required|in:0,1',
                    'delete' => 'required|in:0,1'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $program = AuditProgram::where('id', $id)->update($param_array);

        $data = array(
                'program' => $param,
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
        /*$program = AuditProgram::find($id);
        $program->delete();
        $data = array(
                'program' => $program,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);*/
        
        $program1 = AuditProgram::where('id', $id)->update(array('is_delete'=>'1'));
        $program = AuditProgram::find($id);
        $data = array(
                'program' => $program,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
