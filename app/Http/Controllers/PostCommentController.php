<?php

namespace App\Http\Controllers;

use App\Events\CommentPosted;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PostCommentController extends Controller
{
    public function store(Post $post)
    {
        $validatedData = request()->validate([
            'body' => ['required', 'min:3'],
        ]);

        $validatedData['user_id'] = auth()->id();


        $comment = $post->comments()->create($validatedData); // $post->comment() définit automatiquement le post_id aussi

        // Mail comment
        CommentPosted::dispatch($comment);

        //ddd($user = auth()->user());
        $user = auth()->user();

        //$user->notify(new \App\Notifications\CommentPosted($comment));
        Notification::send($user, new \App\Notifications\CommentPosted($comment));

        return back()->with('success', __('flash-message.post-comment'));
    }
}
