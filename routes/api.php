<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CategoriaController;

Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'store']);

Route::get('/produtos', [ProdutoController::class, 'index']);
Route::get('/produtos/{produto}', [ProdutoController::class, 'show']);
Route::post('/produtos', [ProdutoController::class, 'store']);
Route::put('/produtos/{produto}', [ProdutoController::class, 'update']);
Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy']);
