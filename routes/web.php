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


// create account
Route::get('/signup', [AuthController::class, 'signup_page'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.store');


// newsfeed
Route::get('/feed', [FeedController::class, 'feed'])->name('feed')->middleware('auth');


// posts
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
