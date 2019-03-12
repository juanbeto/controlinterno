<?php

namespace App\Http\Controllers\audit;

use App\AuditInform;
use App\AuditPlanning;
use App\AuditAreas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditInformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->verifiqueAuth($request);
        //$informs = AuditInform::All();

        $informs = AuditInform::rightJoin
            ('audit', 'audit.id', '=', 'audit_inform.id_audit')
            ->select('audit.id AS ID_AUDIT', 'audit_inform.id AS ID_INFORM', 'audit.name')
            ->get();
        return response()->json(array(
                'informs_list'=> $informs,
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
        $inform = new AuditInform();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'ID_AUDIT' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $inform->ID_AUDIT = $param->ID_AUDIT;
            $inform->LOCATION = $param->LOCATION;
            $inform->TYPE_AUDIT = $param->TYPE_AUDIT;
            $inform->EXECUTION = date("Y-m-d H:i:s");;
            $inform->CONCEPT = $param->CONCEPT;
            $inform->ACTIVITIES = $param->ACTIVITIES;
            $inform->NAME_BOSS = $param->NAME_BOSS;
            $inform->CODE = $param->CODE;
            $inform->APPROVED = $param->APPROVED;
            $inform->save();

            $inform_res = AuditInform::where('id', $inform->ID)->get();
            $data = array(
                'inform' => $inform_res[0],
                'status' => 'success111',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AuditInform  $auditInform
     * @return \Illuminate\Http\Response
     */
    public function showByAudit($id)
    {
        $inform = AuditInform::where('id_audit', $id)->get();

        if(count($inform) > 0){
                return response()->json(array(
                        'inform'=> $inform[0],
                        'status'=>'success'
                        ), 200);
        }else{
                return response()->json(array(
                        'inform'=> [],
                        'status'=>'success'
                        ), 200);
        }
    }   

    /**
     * Display the specified resource.
     *
     * @param  \App\AuditInform  $auditInform
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inform = AuditInform::where('id_audit', $id)->get();

        if($inform != null){
                return response()->json(array(
                        'inform'=> $inform[0],
                        'status'=>'success'
                        ), 200);
        }else{
                return response()->json(array(
                        'inform'=> null,
                        'status'=>'success'
                        ), 200);
        }
    }   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AuditInform  $auditInform
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditInform $auditInform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AuditInform  $auditInform
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $json =  $request->input('json', null);
        
        $param = json_decode($json);
        $param_array = json_decode($json, true);//Convierte en array
        $validatedData = \Validator::make($param_array, [ 
                    'ID_AUDIT' => 'required'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        $inform = AuditInform::where('id', $id)->update($param_array);
        $inform_res = AuditInform::where('id', $id)->get();
        $data = array(
                'inform' => $inform_res[0],
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AuditInform  $auditInform
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuditInform $auditInform)
    {
        //
    }


    public function getHallazgos($id, Request $request){

        $am_area = AuditPlanning::join('audit_areas', 'audit_areas.id', '=', 'audit_planning.id_area')->select('audit_areas.name AS AREA', 'audit_areas.id AS id_area')->where('id_audit', $id)->where('ACCORDANCE', 'am')->distinct()->orderBy('ID_AREA')->get()->toArray();
        $nc_area = AuditPlanning::join('audit_areas', 'audit_areas.id', '=', 'audit_planning.id_area')->select('audit_areas.name AS area', 'audit_areas.id AS id_area')->where('id_audit', $id)->where('ACCORDANCE', 'nc')->distinct()->orderBy('audit_areas.name')->get()->toArray();
        $ar_area = AuditPlanning::where('id_audit', $id)->where('ACCORDANCE', 'ar')->select('ID_AREA')->distinct()->orderBy('ID_AREA')->get()->toArray();

        $array_am_pregun = array();
        $array_nc_pregun = array();
        $array_ar_pregun = array();

        if(count($am_area)>0){
            

            foreach ($am_area as $area) {
                $array_am_pregun['area_name'] = $area['AREA'];
                $array_am_pregun['preguntas'] = AuditPlanning::where('id_audit', $id)->where('ACCORDANCE', 'am')->where('id_area', $id_area)->orderBy('ID')->get()->toArray();;
            }
        }

        if(count($nc_area)>0){        

            foreach ($nc_area as $area) {
                $array_nc_pregun['area_name'] = $area['area'];
                $array_nc_pregun['preguntas'] = AuditPlanning::where('id_audit', $id)->where('ACCORDANCE', 'nc')->where('id_area', $area['id_area'])->orderBy('ID')->get()->toArray();;
            }
        }

        if(count($ar_area)>0){        

            foreach ($ar_area as $id_area) {
                $array_ar_pregun['area_name'] = $area['area'];
                $array_ar_pregun['preguntas'] = AuditPlanning::where('id_audit', $id)->where('ACCORDANCE', 'ar')->where('id_area', $id_area)->orderBy('ID')->get()->toArray();;
            }
        }

        
        $preguntas = array('AM'=>(count($array_am_pregun)!=0)?array($array_am_pregun):null,
                            'NC'=>(count($array_nc_pregun)!=0)?array($array_nc_pregun):null,
                            'AR'=>(count($array_ar_pregun)!=0)?array($array_ar_pregun):null);

        return response()->json(array(
        'preguntas'=> $preguntas,
        'status'=>'success'
        ), 200);

    }
}
