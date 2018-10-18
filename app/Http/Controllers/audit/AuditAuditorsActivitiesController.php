<?php

namespace App\Http\Controllers\audit;

use App\AuditAuditorsActivities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditAuditorsActivitiesController extends Controller
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
    public function indexActivitie($id_activities)
    {

        $planning = AuditAuditorsActivities::where('id_activities', $id_activities)->get();
        return response()->json(array(
                'auditors_activities'=> $auditor_activitie,
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
        $auditor_activitie = new AuditAuditorsActivities();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'id_activities' => 'required',
                    'id_user' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $auditor_activitie->id_activities = $param->id_activities;
            $auditor_activitie->id_user = $param->id_user;
            $auditor_activitie->save();

            $data = array(
                'auditors_activities' => $auditor_activitie,
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
        $auditor_activitie = AuditAuditorsActivities::find($id);
        if($auditor_activitie != null){
                return response()->json(array(
                        'auditors_activities'=> $auditor_activitie,
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
     * @param  \App\AuditAuditorsActivities  $AuditAuditorsActivities
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditAuditorsActivities $AuditAuditorsActivities)
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
                    'id_activities' => 'required',
                    'id_user' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $auditor_activitie = AuditAuditorsActivities::where('id', $id)->update($param_array);

        $data = array(
                'auditors_activities' => $param,
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
        $auditor_activitie = AuditAuditorsActivities::find($id);
        $auditor_activitie->delete();
        $data = array(
                'auditors_activities' => $auditor_activitie,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
