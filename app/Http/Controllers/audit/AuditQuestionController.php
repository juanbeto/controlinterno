<?php

namespace App\Http\Controllers\audit;

use App\AuditQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuditQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = AuditQuestion::All();
        return response()->json(array(
                'questions'=> $questions,
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
        $question = new AuditQuestion();
        $request->merge($param_array);
        $validatedData = \Validator::make($param_array, [ 
                    'NAME' => 'required|min:5'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }
            $question->name = $param->NAME;
            $question->save();

            $data = array(
                'question' => $question,
                'status' => 'success',
                'code' => 200
            );

            return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AuditQuestion  $auditQuestion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = AuditQuestion::find($id);
        if($question != null){
                return response()->json(array(
                        'question'=> $question,
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
     * @param  \App\AuditQuestion  $auditQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(AuditQuestion $auditQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AuditQuestion  $auditQuestion
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $json =  $request->input('json', null);
        
        $param = json_decode($json);
        $param_array = json_decode($json, true);//Convierte en array
        $validatedData = \Validator::make($param_array, [ 
                    'NAME' => 'required|min:5'
        ]);        

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 400);
        }

        unset($param_array['ID']);
        unset($param_array['CREATED_AT']);
        $question = AuditQuestion::where('id', $id)->update($param_array);

        $data = array(
                'question' => $param,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AuditQuestion  $auditQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $question = AuditQuestion::find($id);
        $question->delete();
        $data = array(
                'question' => $question,
                'status' => 'success',
                'code' => 200
            );

        return response()->json($data, 200);
    }
}
