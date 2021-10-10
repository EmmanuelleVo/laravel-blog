<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence;

        /*$random = random_int(0, 100);
        $user = $random == 100 ?
            User::factory() :
            ($random >= 88 ?
            User::firstWhere('email', 'emmanuelle.vo@student.hepl.be') :
            User::firstWhere('email', 'sarah.vo@gmail.com')
);
        $random = random_int(0, 100);
        $availableCategories = Category::where('slug', 'family')
            ->orWhere('slug', 'work')
            ->orWhere('slug', 'hobby')
            ->get();
        $category = random_int(0, 100) ?
        Category::factory() :
        $availableCategories[random_int(0, 2)];*/


        return [
            'user_id' => User::factory(),
            //'user_id' => $user,
            'category_id' => Category::factory(),
            //'category_id' => $category,
            'title' => $title,
            'slug' => Str::slug($title, '-') ,//str_slug($title, '-'),
            //'excerpt' => $this->faker->sentence,
            'excerpt' => $this->faker->sentences(2, true),
            //'body' => $this->faker->paragraph,
            'body' => $this->faker->paragraphs(7, true), //true -> text et non array
            'published_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
