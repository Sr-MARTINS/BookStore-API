<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::resource('/usuario', UsuarioController::class);
Route::post('/usuario', [UsuarioController::class, 'create']);
Route::get('/usuario/{id}', [UsuarioController::class, 'show']);
Route::put('/usuario/{id}', [UsuarioController::class, 'update']);
Route::delete('/usuario/{id}', [UsuarioController::class, 'destroy']);
