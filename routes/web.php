<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Ресурсные маршруты
Route::resource('posts', PostController::class);
Route::resource('categories', CategoryController::class);
