<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            $total_order_meals = 0;

            $order = Order::create([
                'table_id' => $request->table_id,
                'reservation_id' => $request->reservation_id,
                'customer_id' => $request->customer_id,
                'waiter_id' => $request->waiter_id,
                'total' => $total_order_meals,
                'date' => $request->date
            ]);

            foreach ($request->meals as $meal) {

                $mealObj = Meal::find($meal['id']);
                
                $total_discount =  $meal['quantity'] * $mealObj['discount'];
                $total_order_meals +=  (($mealObj['price'] * $meal['quantity']) - $total_discount);
               
                // update meals quantity after make order
                $mealObj->update(['quantity_available' => ($mealObj->quantity_available - $meal['quantity'])]);

                OrderDetails::create([
                    'order_id' => $order->id,
                    'meal_id' => $meal['id'],
                    'amount_to_pay' => $meal['quantity'] * ($mealObj->price - $mealObj->discount)
                ]);
            }

            $order->update(['total' => $total_order_meals]);

            return OrderResource::make($order);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return OrderResource::make($order);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        try {
            $order->update([
                'paid' => $request->paid,
            ]);
            return OrderResource::make($order);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return response()->json(['message' => 'deleted success']);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
