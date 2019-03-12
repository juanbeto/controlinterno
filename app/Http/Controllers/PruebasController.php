<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PruebasController extends Controller
{
        /**
     * Display a listing of the resource.
     * @param  int $id_program
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        var_dump($request->header());
        
    }
}
