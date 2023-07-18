<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\WatingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ReservationResource::collection(Reservation::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        $reserved_table = Reservation::where('from_time', '>=', $request->from_time)
            ->orWhere('to_time', '>=', $request->to_time)
            ->where('table_id', $request->table_id)
            ->first();

        $table_capacity = Table::select('capacity')->where('id', $request->table_id)->first();

        // check table capacity
        if ($table_capacity->capacity < $request->num_guests) {

            return response()->json([
                'message' => 'The table you selected has no capacity for the number of guests you want. Please select another table'
            ]);
        }

        // check table reserved or not
        if (
            !$reserved_table
        ) {
            try {
                Reservation::create([
                    'table_id' => $request->table_id,
                    'customer_id' => $request->customer_id,
                    'from_time' => $request->from_time,
                    'to_time' => $request->to_time,

                ]);
                return response()->json([
                    'message' => 'Table reserved successfully.'
                ]);
            } catch (ValidationException $e) {
                return response()->json(['message' => $e->getMessage()]);
            }
        } else {
            WatingList::create([
                'customer_id' => $request->customer_id,
                'num_guests' => $request->num_guests,
                'from_time'    => $request->from_time,
                'to_time' => $request->to_time
            ]);
            return response()->json([
                'message' => 'No tables available. You have been added to the waiting list.'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return ReservationResource::make($reservation);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reserved_table = Reservation::where('from_time', '>=', $request->from_time)
            ->orWhere('to_time', '>=', $request->to_time)
            ->where('table_id', $request->table_id)
            ->first();

        $table_capacity = Table::select('capacity')->where('id', $request->table_id)->first();

        if ($table_capacity->capacity < $request->num_guests) {
        }
        if (
            !$reserved_table
        )
            try {
                $reservation->update([
                    'table_id' => $request->table_id,
                    'customer_id' => $request->customer_id,
                    'from_time' => $request->from_time,
                    'to_time' => $request->to_time
                ]);

                return response()->json([
                    'message' => 'updated success'
                ]);
            } catch (ValidationException $e) {
                return response()->json(['message' => $e->getMessage()]);
            }
            else {
                return response()->json([
                    'message' => 'cannot updated'
                ]);
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->delete();
            return response()->json(['message' => 'deleted success']);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
