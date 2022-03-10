<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        /**
         * @var \Illuminate\Database\Eloquent\Collection $tags
         */
        $tags = Tag::factory()->count(5)->create();
        /**
         * @var \Illuminate\Database\Eloquent\Collection $posts
         */
        $posts = Post::factory()->count(10)->create();

        if ($tags and $posts) {
            foreach ($posts as $post) {
                /**
                 * @var Post $post
                 */
                $firstId = $tags->random()->id;
                $secondId = $tags->except([$firstId])->random()->id;

                $post->tags()->attach([$firstId, $secondId]);
            }
        }
    }
}
