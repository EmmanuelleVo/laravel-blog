<?php


namespace App\Models;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\Document;

class Post
{

    /**
     * Post constructor.
     * @param $title
     * @param $excerpt
     * @param $date
     * @param $body
     * @param $slug
     */
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }


    public static function find($slug)
    {

        $posts = static::all();

        return $posts->firstWhere('slug', $slug);


        /*$path = resource_path("posts/{$slug}.html");
        if (!file_exists($path)) {
            //ddd($path);
            //abort(404);
            //return redirect('/'); // not the job of this method
            throw new ModelNotFoundException();
        }
        // soit une valeur du cache, soit une valeur recalculée // toutes les 1200s, ça expire.
        return cache()->remember("posts/{$slug}", 1200, // pouvoir avoir accès à $path (scope), introduire manuellement use ($path)
            //var_dump('le cache est vide, je vais chercher sur le disque');
            fn() => file_get_contents($path));*/

    }


    public static function all(): Collection
    {
        return cache()->rememberForever('posts.all', function () {

            $files = File::files(resource_path("posts"));

            return collect($files)
                ->map(function ($file) {
                    $document = \Spatie\YamlFrontMatter\YamlFrontMatter::parseFile($file);
                    return new Post($document->title, $document->excerpt, $document->date, $document->body(), $document->slug);
                })
                ->sortByDesc('date');
        });




        /*foreach ($files as $file) {
            $document = \Spatie\YamlFrontMatter\YamlFrontMatter::parseFile($file);
            $posts[] = new Post($document->title, $document->excerpt, $document->date, $document->body(), $document->slug);
        }*/

        /*$models = array_map(function ($post) {
            return $post->getContents();
        }, $posts);

        return $models;*/
    }
}
