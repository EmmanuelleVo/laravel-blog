<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        $post->load('category', 'author', 'comments');

        $page_title = "The post: {$post->title}";

        return view('posts.show', compact('post', 'page_title'));
    }

    public function create()
    {
        return view('posts.create', [
            'page_title' => 'Admin'
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'excerpt' => 'required',
            'thumbnail' => 'image',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        //$attributes['slug'] = Str::slug($attributes['title']);
        $attributes['thumbnail_path'] = request()->file('thumbnail')?->store('thumbnails');  // Ici : imagemagick,..
        unset($attributes['thumbnail']);
        $attributes['user_id'] = auth()->id();
        $attributes['published_at'] = now('Europe/Brussels');

        $post = Post::create($attributes);

        return redirect('/posts/' .$post->slug)->with('success', 'Your post has been created and is now published');


    }
}
