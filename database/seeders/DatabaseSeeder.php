<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        /*$emmanuelle = User::create([
            $name = 'name' => 'Emmanuelle Vo',
            'slug' => Str::slug($name, '-'),
            'email' => 'thienan_vo@live.be',
            'password' => bcrypt('Emmanuelle'),
            'slug' => 'emmanuelle-vo',
        ]);*/

        /* 1000 posts
         * 2% -> new author and category else, first or second
         * Random entre 0 et 100  rand(0, 100)  Si > 99, créer nouvel user/category
         * */

        $emmanuelle = User::factory()->create([
            'name' => 'Emmanuelle Vo',
            'username' => Str::slug('Emmanuelle Vo'),
            'email' => 'emmanuelle.vo@student.hepl.be',

        ]);
        $sarah = User::factory()->create([
            'name' => 'Sarah Vo',
            'username' => Str::slug('Sarah Vo'),
            'email' => 'sarah.vo@gmail.com',

        ]);

        $family = Category::factory()->create([
            'name' => 'Family',
            'slug' => 'family',
        ]);
        $work = Category::factory()->create([
            'name' => 'Work',
            'slug' => 'work',
        ]);
        $hobby = Category::factory()->create([
            'name' => 'Hobby',
            'slug' => 'hobby',
        ]);

        //Post::factory(1000)->create();

        for ($i = 1; $i <=1000; $i++) {

            $randomNumber = rand(0,100);
            $categories = [$family, $work, $hobby];
            //$users = [$emmanuelle, $sarah];

            if($randomNumber > 99) { //2% (99)
                Post::factory()->create(); // new author/category

            } elseif($randomNumber < 66) {
                Post::factory()->create([
                    'user_id' => $emmanuelle,
                    //'category_id' => $family->id,
                    'category_id' => $categories[array_rand($categories)],
                ]);
            }
            /*elseif($randomNumber >= 33 && $randomNumber < 66) {
                Post::factory()->create([
                    'user_id' => $emmanuelle->id,
                    //'category_id' => $work->id,
                    'category_id' => $categories[array_rand($categories)]->id,
                ]);
            }*/ else {
                Post::factory()->create([
                    'user_id' => $sarah,
                    'category_id' => $categories[array_rand($categories)],
                ]);
            }
        }


        // $categories=Category::all(); et faire foreach

        /*Post::create([
            'title'=>'Mon premier post',
            'body'=>'Un méga post pour ma soeur',
            'published_at' => now()->subDays(2),
            'slug'=>'post-1',
            'excerpt'=>'-',
            'category_id' => $family->id,//Category::where('slug', 'family')->first()->id,
            'user_id' => $emmanuelle->id,//User::where('email', 'thienan_vo@live.be')->first()->id,
        ]);

        Post::create([
            'title'=>'Mon deuxième post',
            'body'=>'Un méga post pour mon frère',
            'published_at' => now()->subDays(30),
            'slug'=>'post-2',
            'excerpt'=>'--',
            'category_id' => $family->id,
            'user_id' => $emmanuelle->id,
        ]);

        Post::create([
            'title'=>'Mon troisième post',
            'body'=>'Un méga post sur Laravel',
            'published_at' => now()->subDays(10),
            'slug'=>'post-3',
            'excerpt'=>'---',
            'category_id' => $work->id, //Category::where('slug', 'work')->first()->id,
            'user_id' => $sarah->id,
        ]);

        Post::create([
            'title'=>'Mon quatrième post',
            'body'=>'Un méga post sur VueJS',
            'published_at' => now()->subDays(12),
            'slug'=>'post-4',
            'excerpt'=>'----',
            'category_id' => $hobby->id,
            'user_id' => $sarah->id,
        ]);*/

    }
}
