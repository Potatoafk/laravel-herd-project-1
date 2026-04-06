<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function like($postId)
    {
        Likes::firstOrCreate([
            'post_id' => $postId,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Post liked!');
    }

    public function unlike($postId)
    {
        Likes::where('post_id', $postId)
             ->where('user_id', auth()->id())
             ->delete();

        return redirect()->back()->with('success', 'Post unliked!');
    }
}
