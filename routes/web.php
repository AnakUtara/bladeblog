<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

//Admin Only Route
Route::get('/admin', fn() => 'You are admin!')->can('visit_admin_pages');

//Guest Routes
Route::middleware('guest')->group(function () {
    Route::post('/register', [UserController::class, 'store']);
    Route::post('/login', [UserController::class, 'login']);
});

//Auth Routes
Route::middleware('auth')->group(function () {
    //User
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/avatar', [UserController::class, 'avatarStore']);
    //Post
    Route::post('/post', [PostController::class, 'store']);
    Route::view('/post/create', 'create-post');
    //Post Update Policy Group
    Route::middleware('can:update,post')->group(function () {
        Route::patch('/post/{post}', [PostController::class, 'update']);
        Route::get('/post/{post:slug}/edit', [PostController::class, 'edit']);
    });
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->can('delete', 'post');
});

//Conditional view rendered Route
Route::get('/', [UserController::class, 'show'])->name('login');

//Unprotected Routes
Route::get('/profile/{user:username}', [UserController::class, 'profile']);
Route::get('/post/{post:slug}', [PostController::class, 'show']);
