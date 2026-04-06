<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function view($postId)
    {
        $post = Posts::with([
            'user',
            'comments' => function($query) {
                $query->with('user')->orderBy('created_at', 'desc');
            }
        ])->findOrFail($postId);
        return view('users.comment', compact('post'));
    }

    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        Comments::create([
            'post_id' => $postId,
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('comments.view', $postId)->with('success', 'Comment added successfully!');
    }
}
