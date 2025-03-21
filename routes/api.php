<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ArenaController;
use App\Http\Controllers\API\TimeSlotController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\AuthController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::apiResource('arenas', ArenaController::class);
    Route::apiResource('time-slots', TimeSlotController::class);
    Route::apiResource('bookings', BookingController::class);
    Route::post('bookings/{id}/confirm', [BookingController::class, 'confirm']);
});