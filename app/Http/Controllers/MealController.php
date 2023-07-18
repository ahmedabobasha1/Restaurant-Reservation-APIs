<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMealRequest;
use App\Http\Requests\UpdateMealRequest;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\ValidationException;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MealResource::collection(Meal::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMealRequest $request):JsonResource|JsonResponse
    {
        try {
           $meal =  Meal::create([
                'price' => $request->price,
                'description' => $request->description,
                'quantity_available' => $request->quantity_available,
                'discount' => $request->discount
            ]);

            return MealResource::make($meal);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $meal)
    {
        return new MealResource(Meal::findOrFail($meal));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMealRequest $request, Meal $meal)
    {
        try {

            $meal->update([
                'price' => $request->price,
                'description' => $request->description,
                'quantity_available' => $request->quantity_available,
                'discount' => $request->discount
            ]);
            return MealResource::make($meal->fresh());
        } catch (ValidationException $e) {

            return response()->json(['message' => $e->getMessage(),]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        try{
          $meal->delete();  
        
        return response()->json(['message' => 'deleted success']);
    } catch (ValidationException $e) {
        return response()->json(['message' => $e->getMessage()]);
    }
    }
}
