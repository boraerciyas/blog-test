<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $title = str_replace('.', '', $this->faker->text(30));
        $slug = Str::slug($title);
        return [
            'title' => $title,
            'description' => $this->faker->text(250),
            'author' => $this->faker->name,
            'image_url' => $this->faker->imageUrl('770', '400', 'post', true),
            'slug' => $slug,
            'content' => $this->faker->text(2000),
        ];
    }
}
