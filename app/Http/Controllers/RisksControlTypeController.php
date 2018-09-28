<?php

namespace App\Http\Controllers;

use App\RisksControlType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RisksControlTypeController extends Controller
{
    public function index(){
        $types = RisksControlType::all();
        return response()->json(array(
                'types'=> $types,
                'status'=>'success'
                ), 200);
    }
    //
    public function show($id){
        $type = RisksControlType::find($id);
        if($impact != null){
            return response()->json(array(
                    'type'=> $type,
                    'status'=>'success'
                    ), 200);
        }else{
            return response()->json(array(
                    'status'=>'error'
                    ), 200);
        }    
    }
}
