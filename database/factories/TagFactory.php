<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = str_replace('.', '', $this->faker->text(15));
        $slug = Str::slug($name);
        return [
            'key' => $slug,
            'name' => $name,
        ];
    }
}
