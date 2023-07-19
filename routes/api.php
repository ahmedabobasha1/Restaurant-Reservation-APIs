<?php

use App\Http\Controllers\AuthController;
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
    Route::get('/', [MealController::class, 'index']);
    Route::post('/', [MealController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{meal}', [MealController::class, 'show']);
    Route::post('/{meal}', [MealController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{meal}', [MealController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::prefix('tables')->group(function () {
    Route::get('/', [TableController::class, 'index']);
    Route::post('/', [TableController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/{table}', [TableController::class, 'show']);
    Route::post('/{table}', [TableController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{table}', [TableController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::prefix('customers')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/', [CustomerController::class, 'store']);
    Route::get('/{customer}', [CustomerController::class, 'show'])->middleware('auth:sanctum');
    Route::post('/{customer}', [CustomerController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{customer}', [CustomerController::class, 'destroy'])->middleware('auth:sanctum');
});


Route::prefix('reservations')->group(function () {
    Route::get('/', [ReservationController::class, 'index']);
    Route::post('/', [ReservationController::class, 'store']);
    Route::get('/{reservation}', [ReservationController::class, 'show']);
    Route::post('/{reservation}', [ReservationController::class, 'update']);
    Route::delete('/{reservation}', [ReservationController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/', [OrderController::class, 'store']);
    Route::get('/{order}', [OrderController::class, 'show']);
    Route::post('/{order}', [OrderController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('/{order}', [OrderController::class, 'destroy'])->middleware('auth:sanctum');
});
Route::get('/checkout/{table_number}', [CheckoutController::class, 'getCheckout']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
