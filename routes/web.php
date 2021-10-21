<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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

    $posts = Post::latest('published_at')
        ->with('category', 'author')
        ->get();
    $categories = Category::whereHas('posts')
        ->orderBy('name')
        ->get();
    $users = User::whereHas('posts')
        ->orderBy('name')
        ->get();
    /*$page_title = liste de tous les posts, liste de la catégorie, liste de l'auteur'*/;

    return view('posts.index', compact('posts', 'categories', 'users'));
    //return 'hello world'; // pratique pour debug
    //return ['message' => 'Hello World']; // peut retourner du json -> pratique pour API et debug
});


/* LISTE DE TOUS LES POSTS */
Route::get('/', [\App\Http\Controllers\PostController::class, 'index']) ->name('home');
    /*{
    //$posts = Post::all(); //récupérer uniquement les posts sans relation
    // collection de posts avec les catégories qui leur sont associées; with -> eager loading
    //dd($posts->toSql());


}*/


/* UN POST  */ // clé dans la route = nom de la variable, ici post
Route::get('/posts/{post:slug}', [\App\Http\Controllers\PostController::class, 'show']);
/*{ // {post} = comme variable dans l'url, wildcard //$slug retourne le slug de l'URL; Route Model Binding
    // Find a post by its slug and pass it to a view called "post"
    //$post = Post::where('slug', $slug)->firstOrFail(); //get() donne Collection et first() donne directement le post


})*/;//->where('post', '[A-z0-9_\-]+'); // accepte la route pour les valeurs de post pour les expressions régulières... d'au moins un caractère A à z et -
/*// affiche la liste des catégories
Route::get('/categories', function () {
    /*\Illuminate\Support\Facades\DB::listen(function ($query) {
        logger($query->sql, $query->bindings);
    });
    $categories = \App\Models\Category::with('posts.author')->get(); //récupérer uniquement les posts sans relation
    // collection de posts avec les catégories qui leur sont associées
    return view('categories',
        [
            'page_title' => 'Liste des catégories',
            'categories' => $categories
        ]);
});*/
/*// Titre de la catégorie et les posts de cette catégorie avec lien vers toutes les catégories
Route::get('/categories/{category:slug}', function (Category $category) {

    $page_title = "All posts from: {$category->name}";
    $categories = Category::whereHas('posts')
        ->orderBy('name')
        ->get();
    $posts = $category->posts;
    $posts->load('category', 'author');
    $users = User::whereHas('posts')
        ->orderBy('name')
        ->get();
    $currentCategory = $category;

    return view('posts', compact('category', 'page_title', 'categories', 'posts', 'users', 'currentCategory'));
})->name('single-category');*/
/*Route::get('/users', function () {

    $users = User::with('posts')->get();

    return view('users',
        [
            'page_title' => 'Liste des auteurs',
            'users' => $users
        ]);
});*/
/*Route::get('/users/{user:slug}', function (User $user) {

    $user->load('posts.category');
    $page_title = "All posts from: {$user->name}";
    $posts = $user->posts;
    $posts->load('author');
    $categories = Category::whereHas('posts')
        ->orderBy('name')
        ->get();
    $users = User::whereHas('posts')
        ->orderBy('name')
        ->get();
    $currentAuthor = $user;


    return view('posts.index', compact('user', 'page_title', 'posts', 'categories', 'users', 'currentAuthor'));
});*/

Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'create']);
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'store']);




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
