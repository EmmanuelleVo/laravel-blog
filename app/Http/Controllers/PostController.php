<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        //$posts = Post::latest('published_at')->with('category', 'author'); ///requête sql, ->get() exécute cette requête
        /*if(request('search')) {
            $posts
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('excerpt', 'like', '%' . request('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%');
        }*/

        $filters = request(['search', 'category', 'author']); // ou request()->only(search, category)

        return view('posts.index', [
            'posts' => Post::filter($filters)
                ->latest('published_at')
                ->with('category', 'author')
                ->paginate(6)
                ->withQueryString(),
            'page_title' => 'Posts lists',

        ]);
    }

    public function show(Post $post)
    {
        $post->load('category', 'author');

        $page_title = "The post: {$post->title}";

        return view('posts.show', compact('post', 'page_title'));
    }
}
