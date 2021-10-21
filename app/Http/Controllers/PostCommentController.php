<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(Post $post)
    {
        $validatedData = request()->validate([
            'body' => ['required', 'min:3'],
        ]);

        $validatedData['user_id'] = auth()->id();

        $post->comments()->create($validatedData); // $post->comment() définit automatiquement le post_id aussi

        return back()->with('success', __('flash-message.post-comment'));
    }
}
