<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $post = Posts::create([
            'user_id' => auth()->user()->user_id,
            'content' => $validated['content'],
        ]);

        return redirect()->route('feed')->with('success', 'Post created successfully!');
    }

    public function destroy(Posts $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('feed')->with('success', 'Post deleted successfully!');
    }
}
