<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facedes\DB;
use App\Risks;
use Illuminate\Http\Request;

class RisksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $risks = Risks::all();
        return response()->json(array(
                'risks'=> $risks,
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
        $risks = new Risks();
        $request->merge($param_array);
        try{
                $validatedData = $this->validate($request, [ 
                    'code' => 'required',
                    'id_process' => 'required',
                    'id_period' => 'required',
                    'name' => 'required|min:5',
                    'description' => 'required',
                    'effects' => 'required',
                    'causes' => 'required',
                    'classification' => 'required',
                    'factor' => 'required',
                    'factorvulnerability' => 'required',
                    'probability' => 'required'
                ]);
            }catch(\Illuminate\Validation\ValidationException $e){
                return $e->getResponse();
            }     

            $risks->code = $param->code;
            $risks->id_process = $param->id_process;
            $risks->id_period = $param->id_period;
            $risks->name = $param->name;
            $risks->description = $param->description;
            $risks->effects = $param->effects;
            $risks->causes = $param->causes;
            $risks->classification = $param->classification;
            $risks->object = $param->object;
            $risks->factor = $param->factor;
            $risks->factorvulnerability = $param->factorvulnerability;
            $risks->probability = $param->probability;
            $risks->createdate = date("Y-m-d H:i:s");
            $risks->save();

            $data = array(
                'risk' => $risks,
                'status' => 'success',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Risks  $risks
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $risks = Risks::find($id);
        if($risks != null){
                return response()->json(array(
                        'risks'=> $risks,
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
     * @param  \App\Risks  $risks
     * @return \Illuminate\Http\Response
     */
    public function edit(Risks $risks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Risks  $risks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Risks $risks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Risks  $risks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Risks $risks)
    {
        //
    }
}
