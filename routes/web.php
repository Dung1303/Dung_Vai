<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrangChuController;
use App\Http\Controllers\ProductController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/trangchu', [TrangChuController::class, 'index']);
Route::resource('products', ProductController::class);