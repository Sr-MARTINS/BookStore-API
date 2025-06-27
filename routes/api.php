<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\Tarefa_statusController;
use App\Http\Controllers\TarefaController;

Route::get('/user', [UserController::class, 'index']);
Route::post('/user', [UserController::class, 'create']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);

Route::get('/lista', [ListaController::class, 'index']);
Route::post('/lista', [ListaController::class, 'create']);
Route::get('/lista/{id}', [ListaController::class, 'show']);
Route::put('/lista/{id}', [ListaController::class, 'update']);
Route::delete('/lista/{id}', [ListaController::class, 'destroy']);

Route::get('/status', [Tarefa_statusController::class, 'index']);
Route::post('/status', [Tarefa_statusController::class, 'create']);
Route::get('/status/{id}', [Tarefa_statusController::class, 'show']);
Route::put('/status/{id}', [Tarefa_statusController::class, 'update']);
Route::delete('/status/{id}', [Tarefa_statusController::class, 'destroy']);

Route::get('/lista/{id}/tarefa', [TarefaController::class, 'index']);
Route::post('/lista/{id}/tarefa', [TarefaController::class, 'create']);
Route::get('/lista/{id}/tarefa/{id}', [TarefaController::class, 'show']);
Route::put('/lista/{id}/tarefa/{id}', [TarefaController::class, 'update']);
Route::delete('/lista/{id}/tarefa/{id}', [TarefaController::class, 'destroy']);
