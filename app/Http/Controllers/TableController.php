<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Http\Resources\TableResource;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TableResource::collection(Table::all());
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTableRequest $request)
    {
        try{
            $Table =  Table::create([
            'capacity' => $request->capacity
        ]);
        return TableResource::make($Table);
    } catch (ValidationException $e) {
        return response()->json(['message' => $e->getMessage()]);
    }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        return TableResource::make($table);
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableRequest $request, Table $table)
    {
        try{
            $table->update([
                'capacity'=>$request->capacity
            ]);
            return TableResource::make($table);

        } catch (ValidationException $e) {
        return response()->json(['message' => $e->getMessage()]);
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        try{
            $table->delete();
            return response()->json(['message'=>'deleted success']);

        } catch (ValidationException $e) {
        return response()->json(['message' => $e->getMessage()]);
    }
    }
}
