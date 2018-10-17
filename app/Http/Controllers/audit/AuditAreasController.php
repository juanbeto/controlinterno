<?php

namespace App\Http\Controllers\audit;

use App\AuditAreas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditAreasController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = AuditAreas::all();
        return response()->json(array(
                'areas'=> $areas,
                'status'=>'success'
                ), 200);
    }   

    public function show($id){
        $area = AuditAreas::find($id);
        if($area != null){
            return response()->json(array(
                    'area'=> $area,
                    'status'=>'success'
                    ), 200);
        }else{
            return response()->json(array(
                    'status'=>'error'
                    ), 200);
        }    
    }
}
