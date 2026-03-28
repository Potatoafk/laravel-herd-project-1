<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
// use App\Http\Controllers\ProfileController;

// homepage
Route::get('/', [HomeController::class, 'homepage'])->name('homepage');

// login
Route::post('/login', [HomeController::class, 'login'])->name('login');

// create account
Route::get('/signup', [AuthController::class, 'signup_page'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.store');

// newsfeed
Route::get('/feed', [FeedController::class, 'feed'])->name('feed');

// comment
Route::get('/comment', [CommentController::class, 'comment'])->name('comment');

// profile
// Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
