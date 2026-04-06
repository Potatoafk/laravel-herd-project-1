<?php

namespace App\Http\Controllers;
use App\Models\Posts;
// use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile() {
        $posts = Posts::where('user_id', auth()->id())->with('user', 'comments', 'likes')->latest('created_at')->get();
        return view('users.profile', compact('posts'));
    }
}
