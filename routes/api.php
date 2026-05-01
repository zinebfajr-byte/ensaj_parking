<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParkingSpotController;
use App\Http\Controllers\ReservationController;

// Routes publiques (pas besoin d'être connecté)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Routes protégées (il faut être connecté)
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Places de parking
    Route::apiResource('parking-spots', ParkingSpotController::class);

    // Réservations
    Route::apiResource('reservations', ReservationController::class);
});