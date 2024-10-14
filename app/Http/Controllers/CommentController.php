<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}