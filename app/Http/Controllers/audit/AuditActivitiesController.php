<?php

namespace App\Http\Controllers\audit;

use App\AuditActivities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = AuditActivities::all();
        return response()->json(array(
                'activities'=> $activities,
                'status'=>'success'
                ), 200);
    }

    
    /**
    * Show the lists of activities associated to Audit
    */
    public function indexAudit($id_audit)
    {

        $activities = AuditActivities::where('id_audit', $id_audit)->get();
        return response()->json(array(
                'activities'=> $activities,
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
        $activitie = new AuditActivities();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'ID_AUDIT' => 'required',
                    'BEGIN' => 'required',
                    'END' => 'required',
                    'NAME' => 'required|min:5',
                    'NUMERALS_ISO' => 'required',
                    'NUMERALS_MECI' => 'required',
                    'ID_USER_AUDITOR' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
        $activitie->ID_AUDIT = $param->ID_AUDIT;
        $activitie->BEGIN = $param->BEGIN;
        $activitie->END = $param->END;
        $activitie->NAME = $param->NAME;
        $activitie->NUMERALS_ISO = $param->NUMERALS_ISO;
        $activitie->NUMERALS_MECI = $param->NUMERALS_MECI;
        $activitie->ID_USER_AUDITOR = $param->ID_USER_AUDITOR;
        $activitie->save();

        $data = array(
            'activitie' => $activitie,
            'status' => 'success',
            'code' => 200
        );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AuditActivities  $auditActivities
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activitie = AuditActivities::find($id);
        if($activitie != null){
                return response()->json(array(
                        'activitie'=> $activitie,
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
     * @param  \App\AuditActivities  $auditActivities
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditActivities $auditActivities)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AuditActivities  $auditActivities
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
                    'ID_AUDIT' => 'required',
                    'BEGIN' => 'required',
                    'END' => 'required',
                    'NAME' => 'required|min:5',
                    'NUMERALS_ISO' => 'required',
                    'NUMERALS_MECI' => 'required',
                    'ID_USER_AUDITOR' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $activitie = AuditActivities::where('id', $id)->update($param_array);

        $data = array(
                'activitie' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AuditActivities  $auditActivities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $activitie = AuditActivities::find($id);
        $activitie->delete();
        $data = array(
                'activitie' => $activitie,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
