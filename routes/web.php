<?php

use App\Models\Post;
use App\Models\User;
use App\Events\ChatMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Mail\NewPostEmail;
use App\Mail\RecapMail;

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
    //User Follows/Unfollows
    Route::post('/user/{user}/follow', [FollowController::class, 'create']);
    Route::post('/user/{user}/unfollow', [FollowController::class, 'destroy']);
    //Post
    Route::post('/post', [PostController::class, 'store']);
    Route::view('/post/create', 'create-post');
    //Post Update Policy Group
    Route::middleware('can:update,post')->group(function () {
        Route::patch('/post/{post}', [PostController::class, 'update']);
        Route::get('/post/{post:slug}/edit', [PostController::class, 'edit']);
    });
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->can('delete', 'post');
    Route::get('/search', [PostController::class, 'search']);
    //Chat Routes
    Route::post('/send-chat', function () {
        $chat = request()->validate([
            'message' => ['required', 'string', 'max:500'],
        ]);
        $strippedChat = strip_tags($chat['message']);
        if (!trim($strippedChat)) {
            return response()->noContent();
        }
        broadcast(new ChatMessage([
            'username' => Auth::user()->username,
            'message' => strip_tags(request()->message),
            'avatar' => Auth::user()->avatar
        ]))->toOthers();
        return response()->noContent();
    });
});

//Conditional view rendered Route
Route::get('/', [UserController::class, 'show'])->name('login');

//Unprotected Routes
Route::get('/profile/{user:username}', [UserController::class, 'profile']);
Route::get('/post/{post:slug}', [PostController::class, 'show']);

//Preview mail route
Route::get('/mail', function () {
    $user = User::find(1);
    return new RecapMail([
        'username' => $user->username,
        'postCount' => $user->posts->count(),
        'followersCount' => $user->followers->count(),
        'followingsCount' => $user->following->count(),
    ]);
});
