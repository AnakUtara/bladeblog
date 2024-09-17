<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//User Routes
Route::get('/', [UserController::class, 'homeView']);
Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

//Blog Routes
Route::view('/post/create', 'create-post');
Route::post('/post', [PostController::class, 'store']);
