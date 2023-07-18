<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservController;
use App\Http\Controllers\TableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('meals')->group(function () {
     Route::get('/',[MealController::class,'index']);
     Route::post('/',[MealController::class,'store']);
     Route::get('/{meal}',[MealController::class,'show']);
     Route::post('/{meal}',[MealController::class,'update']);
     Route::delete('/{meal}',[MealController::class,'destroy']);
});

Route::prefix('tables')->group(function () {
    Route::get('/',[TableController::class,'index']);
    Route::post('/',[TableController::class,'store']);
    Route::get('/{table}',[TableController::class,'show']);
    Route::post('/{table}',[TableController::class,'update']);
    Route::delete('/{table}',[TableController::class,'destroy']);
});

Route::prefix('customers')->group(function () {
    Route::get('/',[CustomerController::class,'index']);
    Route::post('/',[CustomerController::class,'store']);
    Route::get('/{customer}',[CustomerController::class,'show']);
    Route::post('/{customer}',[CustomerController::class,'update']);
    Route::delete('/{customer}',[CustomerController::class,'destroy']);
});


Route::prefix('reservations')->group(function () {
    Route::get('/',[ReservationController::class,'index']);
    Route::post('/',[ReservationController::class,'store']);
    Route::get('/{reservation}',[ReservationController::class,'show']);
    Route::post('/{reservation}',[ReservationController::class,'update']);
    Route::delete('/{reservation}',[ReservationController::class,'destroy']);
});

Route::prefix('orders')->group(function () {
    Route::get('/',[OrderController::class,'index']);
    Route::post('/',[OrderController::class,'store']);
    Route::get('/{order}',[OrderController::class,'show']);
    Route::post('/{order}',[OrderController::class,'update']);
    Route::delete('/{order}',[OrderController::class,'destroy']);
});
Route::get('/checkout/{table_number}', [CheckoutController::class,'getCheckout']);
