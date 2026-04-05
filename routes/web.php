<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

// homepage
Route::get('/', [HomeController::class, 'homepage'])->name('homepage');


// login
Route::post('/login', [HomeController::class, 'login'])->name('login');

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// create account
Route::get('/signup', [AuthController::class, 'signup_page'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.store');


// newsfeed
Route::get('/feed', [FeedController::class, 'feed'])->name('feed')->middleware('auth');


// posts
Route::post('/post', [PostController::class, 'post'])->name('posts.create')->middleware('auth');
