<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::resource('/usuario', UsuarioController::class);
Route::resource('/categoria', CategoriaController::class);
Route::resource('/book', BookController::class);