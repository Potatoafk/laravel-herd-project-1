<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FriendController;
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

// messages
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index')->middleware('auth');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store')->middleware('auth');
Route::delete('/messages/{messageId}', [MessageController::class, 'delete'])->name('messages.delete')->middleware('auth');


// friends
Route::get('/friends', [FriendController::class, 'index'])->name('friends.index')->middleware('auth');
Route::post('/friends', [FriendController::class, 'store'])->name('friends.store')->middleware('auth');
Route::post('/friends/{friendshipId}/accept', [FriendController::class, 'accept'])->name('friends.accept')->middleware('auth');
Route::post('/friends/{friendshipId}/decline', [FriendController::class, 'decline'])->name('friends.decline')->middleware('auth');
Route::delete('/friends/{friendshipId}', [FriendController::class, 'destroy'])->name('friends.destroy')->middleware('auth');


// catch-all route for 404
Route::fallback(function () {
    return view('404');
});
