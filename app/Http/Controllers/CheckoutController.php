<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function getCheckout(int $table_number)
    {
        $order_data = Order::where('table_id',$table_number)->latest()->first();
        return view('invoke', compact('order_data'));
       
    }
}
