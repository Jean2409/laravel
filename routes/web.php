<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;

Route::get('/', [VentaController::class, 'index']);
Route::post('/registrar', [VentaController::class, 'store']);
Route::get('/datos', [VentaController::class, 'datos']);
