<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// homepage
Route::get('/', [HomeController::class, 'homepage'])->name('homepage');


// login
Route::post('/login', [HomeController::class, 'login'])->name('login');

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// create account
Route::get('/signup', [AuthController::class, 'signup_page'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.store');


// user profile
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware('auth');


// newsfeed
Route::get('/feed', [FeedController::class, 'feed'])->name('feed')->middleware('auth');


// posts
Route::post('/post', [PostController::class, 'post'])->name('posts.create')->middleware('auth');

// likes
Route::post('/post/{postId}/like', [LikesController::class, 'like'])->name('posts.like')->middleware('auth');
Route::post('/post/{postId}/unlike', [LikesController::class, 'unlike'])->name('posts.unlike')->middleware('auth');


// comments
Route::get('/post/{postId}/comment', [CommentController::class, 'view'])->name('comments.view')->middleware('auth');
Route::post('/post/{postId}/comment', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
