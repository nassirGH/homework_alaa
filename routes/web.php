<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/posts', \App\Http\Controllers\PostController::class);

Route::resource('categories', CategoryController::class);
