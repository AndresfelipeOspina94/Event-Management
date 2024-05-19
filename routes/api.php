<?php

use Illuminate\Http\Request;
use App\Http\Controllers\api\EventoController;
use App\Http\Controllers\api\PonenteController;
use App\Http\Controllers\api\AsistenteController;
use App\Http\Controllers\api\SesionController;
use App\Http\Controllers\api\InscripcionController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('eventos', EventoController::class);
Route::apiResource('ponentes', PonenteController::class);
Route::apiResource('asistentes', AsistenteController::class);
Route::apiResource('sesiones', SesionController::class);
Route::apiResource('inscripciones', InscripcionController::class);