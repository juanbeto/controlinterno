<?php

namespace App\Http\Controllers\audit;

use App\AuditAuditors;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditAuditorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
    * Show the lists of auditors associated to Audit
    */
    public function indexAudit($id_audit)
    {

        $auditors = AuditAuditors::where('id_audit', $id_audit)->get();
        return response()->json(array(
                'auditors'=> $auditors,
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
        $auditor = new AuditAuditors();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_audit' => 'required',
                    'id_user' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $auditor->id_audit = $param->id_audit;
            $auditor->id_user = $param->id_user;
            $auditor->save();

            $data = array(
                'auditor' => $auditor,
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
        $auditor = AuditAuditors::find($id);
        if($auditor != null){
                return response()->json(array(
                        'auditor'=> $auditor,
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
     * @param  \App\AuditAuditors  $auditAuditors
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditAuditors $auditAuditors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
                    'id_audit' => 'required',
                    'id_user' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $auditor = AuditAuditors::where('id', $id)->update($param_array);

        $data = array(
                'auditor' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $auditor = AuditAuditors::find($id);
        $auditor->delete();
        $data = array(
                'auditor' => $auditor,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
