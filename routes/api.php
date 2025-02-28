<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BarberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/barbers", [BarberController::class, "index"])->name("barbers.index");
Route::post("/barbers", [BarberController::class, "store"])->name("barbers.store");
Route::delete("/barbers", [BarberController::class, "destroy"])->name("barbers.destroy");

Route::get('/appointments', [AppointmentController::class, "index"])->name("appointments.index");
Route::post('/appointments', [AppointmentController::class, "store"])->name("appointments.store");
Route::delete('/appointments', [AppointmentController::class, "destroy"])->name("appointments.destroy");