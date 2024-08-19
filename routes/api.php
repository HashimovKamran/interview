<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleTypeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'jwt-roles'], function () {
    Route::post('/transport/prices', [VehicleTypeController::class, 'calculate']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('login', [AuthController::class, 'login']);
