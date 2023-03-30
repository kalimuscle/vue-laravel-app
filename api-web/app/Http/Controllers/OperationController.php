<?php

namespace App\Http\Controllers;
use App\Models\Operation;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function index()
    {
        $operations = Operation::latest()->paginate(10);
        return response()->json([
            "status" => 1,
            "data" => $operations
        ]);
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
        $request->validate([
            'pair' => 'required',
            'type_operation' => 'required',
            'amount' => 'required',
            'volumen' => 'required'
        ]);

        $operation = new Operation;
 
        $operation->pair = $request->pair;
        $operation->type_operation = $request->type_operation;
        $operation->amount = $request->amount;
        $operation->volumen = $request->volumen;
        $operation->user_id = $request->user()->id;
 
        $operation->save();

        return response()->json([
            "status" => 1,
            "data" => $operation
        ]);
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function show(Operation $operation)
    {
        return response()->json([
            "status" => 1,
            "data" =>$operation
        ]);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(Operation $operation)
    {
        //
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operation $operation)
    {
        $request->validate([
            'pair' => 'required',
            'type_operation' => 'required',
            'amount' => 'required',
            'volumen' => 'required'
        ]);
 
        $operation->update($request->all());
 
        return response()->json([
            "status" => 1,
            "data" => $operation,
            "msg" => "Blog updated successfully"
        ]);
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operation $operation)
    {
        $operation->delete();
        return response()->json([
            "status" => 1,
            "data" => $operation,
            "msg" => "Blog deleted successfully"
        ]);
    }
}
