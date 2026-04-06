<?php

namespace App\Http\Controllers;

use App\Models\Posts;
// use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function feed() {
        $posts = Posts::with('user', 'comments', 'likes')->latest('created_at')->get();
        return view('users.feed', compact('posts'));
    }
}
