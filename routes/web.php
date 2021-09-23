<?php

use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ClassName::function : façade

Route::get('/posts', function () {
    return view('posts');
    //return 'hello world'; // pratique pour debug
    //return ['message' => 'Hello World']; // peut retourner du json -> pratique pour API et debug
});




/* LISTE DE TOUS LES POSTS */
Route::get('/', function () {

    $posts = Post::all();

    return view('posts',
        ['posts' => $posts,
            'page_title' => 'La liste des posts'
        ]);
});


/* UN POST  */
Route::get('/posts/{post}', function ($slug) { // {post} = comme variable dans l'url, wildcard //$slug retourne le slug de l'URL
    // Find a post by its slug and pass it to a view called "post"


    $post = Post::find($slug);
    $page_title = "Le post: {$post->title}";

    return view('post', compact('post', 'page_title'));
})->where('post', '[A-z0-9_\-]+'); // accepte la route pour les valeurs de post pour les expressions régulières... d'au moins un caractère A à z et -











/*Route::get('/playground', function () {

    $files = File::files(resource_path("posts"));
    $posts = [];

    //$document = \Spatie\YamlFrontMatter\YamlFrontMatter::parseFile(resource_path('posts/my-first-post.html'));

    foreach ($files as $file) {
        $document = \Spatie\YamlFrontMatter\YamlFrontMatter::parseFile($file);
        $posts[] = new Post($document->title, $document->excerpt, $document->date, $document->body(), $document->slug);
    }

    return $posts;
});*/
