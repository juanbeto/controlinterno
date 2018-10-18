<?php

namespace App\Http\Controllers\audit;

use App\AuditFormat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditFormatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $format = AuditFormat::all();
        return response()->json(array(
                'format'=> $format,
                'status'=>'success'
                ), 200);
    }   

    public function show($id){
        $format = AuditFormat::find($id);
        if($format != null){
            return response()->json(array(
                    'format'=> $format,
                    'status'=>'success'
                    ), 200);
        }else{
            return response()->json(array(
                    'status'=>'error'
                    ), 200);
        }    
    }
}
