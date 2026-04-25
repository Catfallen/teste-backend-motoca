<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\AuthController;


// ROTAS PÚBLICAS

// Vehicles (somente leitura pública)
Route::get('/vehicles', [VehicleController::class, 'index']);
Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show']);

// Leads (criação pública — requisito importante)
Route::post('/leads', [LeadController::class, 'store']);



// Auth
Route::post('/login', [AuthController::class, 'login']);


//ROTAS PROTEGIDAS

Route::middleware('auth:api')->group(function () {
    // Vehicles (CRUD protegido)
    Route::post('/vehicles', [VehicleController::class, 'store']);
    Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update']);
    Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy']);

    // Leads (admin pode listar e gerenciar)
    Route::get('/leads', [LeadController::class, 'index']);
    Route::get('/leads/{lead}', [LeadController::class, 'show']);
    Route::put('/leads/{lead}', [LeadController::class, 'update']);
    Route::delete('/leads/{lead}', [LeadController::class, 'destroy']);

    // Listar leads por veículo (diferencial)
Route::get('/vehicles/{id}/leads', [LeadController::class, 'byVehicle']);
});