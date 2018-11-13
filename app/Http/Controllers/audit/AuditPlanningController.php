<?php

namespace App\Http\Controllers\audit;

use App\AuditPlanning;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditPlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plannings = AuditPlanning::All();
        return response()->json(array(
                'plannings'=> $plannings,
                'status'=>'success'
                ), 200);
    }

    /**
    * Show the lists of activities associated to Audit
    */
    public function indexAudit($id_audit)
    {

        $plannings = AuditPlanning::where('id_audit', $id_audit)->orderBy('id_area', 'cycle')->with('AuditAreas')->get();        
        return response()->json(array(
                'plannings'=> $plannings,
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
        $planning = new AuditPlanning();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'ID_AUDIT' => 'required',
                    'ID_AREA' => 'required',
                    'CYCLE' => 'required|in:P,H,V,A',
                    'QUESTION' => 'required'                    
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $planning->id_audit = $param->ID_AUDIT;
            $planning->id_area = $param->ID_AREA;
            $planning->cycle = $param->CYCLE;
            $planning->question = $param->QUESTION;
            $planning->numerals_iso = $param->NUMERALS_ISO;
            $planning->numerals_meci = $param->NUMERALS_MECI;
            $planning->records = $param->RECORDS;
            $planning->observation = $param->OBSERVATION;
            $planning->accordance = $param->ACCORDANCE;
            $planning->action = $param->ACTION;
            $planning->save();

            $data = array(
                'planning' => $planning,
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
        $planning = AuditPlanning::find($id);
        if($planning != null){
                return response()->json(array(
                        'planning'=> $planning,
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
     * @param  \App\AuditPlanning  $auditPlanning
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditPlanning $auditPlanning)
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
                    'ID_AUDIT' => 'required', 
                    'ID_AREA' => 'required',
                    'CYCLE' => 'required|in:P,H,V,A',
                    'QUESTION' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $planning = AuditPlanning::where('id', $id)->update($param_array);

        $data = array(
                'planning' => $param,
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
        $planning = AuditPlanning::find($id);
        $planning->delete();
        $data = array(
                'planning' => $planning,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
