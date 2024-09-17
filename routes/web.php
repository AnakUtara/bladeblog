<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//Guest Routes
Route::middleware('guest')->group(function () {
    Route::post('/register', [UserController::class, 'store']);
    Route::post('/login', [UserController::class, 'login']);
});

//Auth Routes
Route::middleware('auth')->group(function () {
    //User
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/profile/{user:username}', [UserController::class, 'profile']);
    //Post
    Route::post('/post', [PostController::class, 'store']);
    Route::view('/post/create', 'create-post');
    Route::delete('/post/{post}', [PostController::class, 'destroy']);
    //Profile
});
//Conditional view rendered Route
Route::get('/', [UserController::class, 'show'])->name('login');

//Unprotected Routes
Route::get('/post/{post:slug}', [PostController::class, 'show']);
