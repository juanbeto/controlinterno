<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facedes\DB;

use App\RisksFactorType;
use Illuminate\Http\Request;

class RisksFactorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type = RisksFactorType::all();
        return response()->json(array(
                'factortypes'=> $type,
                'status'=>'success'
                ), 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\RisksFactorType  $risksFactorType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = RisksFactorType::find($id);
        if($type != null){
                return response()->json(array(
                        'factortype'=> $type,
                        'status'=>'success'
                        ), 200);
        }else{
            return response()->json(array(
                        'status'=>'error'
                        ), 200);
        }    
    }
}
