<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;

Route::get('/walk-in-report/{year}', [ReportController::class, 'monthlyReport']);
Route::get('/non-json', [ReportController::class, 'nonJSOn']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
