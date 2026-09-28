<?php

use App\Http\Controllers\ContainerTelemetryController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/store', [ContainerTelemetryController::class,'store']);

// Route::post('/login/register',[LoginController::class,'register'])->name('register');

