<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LikeController;

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/posts', [PostController::class, 'index']); // Make posts listing public
Route::get('/posts/{post}', [PostController::class, 'show']); // Make post details public

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {
    // Profil utilisateur
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Posts (protected operations)
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
    Route::get('/user/posts', [PostController::class, 'userPosts']);

    // Commentaires
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

    // Likes
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle']);
    Route::get('/posts/{post}/likes', [LikeController::class, 'index']);
    Route::get('/posts/{post}/likes/count', [LikeController::class, 'count']);
});
