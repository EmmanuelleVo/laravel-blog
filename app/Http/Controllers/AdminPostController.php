<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50),
            'page_title' => 'Admin : posts',
        ]);
    }

    public function create()
    {
        return view('admin.posts.create', [
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

        return redirect('/posts/' . $post->slug)->with('success', 'Your post has been created and is now published');

    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'page_title' => 'Post edit',
            'post' => $post,
        ]);
    }

    public function update(Post $post)
    {
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'slug' => ['required', 'max:255', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => 'required',
            'thumbnail' => 'image',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail_path'] = request()->file('thumbnail')?->store('thumbnails');
            unset($attributes['thumbnail']);
        }

        $post->update($attributes);

        return back()->with('success', 'Post Updated');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success', 'Post Deleted');
    }
}
