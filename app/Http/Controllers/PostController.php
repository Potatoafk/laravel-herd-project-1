<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function post(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        Posts::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('feed')->with('success', 'Post created successfully!');
    }
}
