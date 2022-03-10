<?php

namespace Tests\Http\Controllers;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CommentControllerTest extends TestCase
{
    private $faker;
    private $post;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->post = Post::factory()->create();
    }

    public function testStore()
    {
        $formData =
            [
                'user_name' => $this->faker->text(500), // max number of chars should be 255
                'user_email' => $this->faker->text(50), // should be a valid mail
                'content' => "", // Required
                'post_id' => -1, // It has to exist in the posts table.
            ];

        $this->postJson('/api/comments', $formData)
            ->assertStatus(422)
            ->assertJson(function (AssertableJson $json) {
                $json->has('message')
                    ->has('errors', 4)
                    ->whereAllType([
                        'errors.user_name' => 'array',
                        'errors.user_email' => 'array',
                        'errors.content' => 'array',
                        'errors.post_id' => 'array',
                    ]);
            });

        $formData =
            [
                'user_name' => $this->faker->name,
                'user_email' => $this->faker->email,
                'content' => $this->faker->text(1000),
                'post_id' => $this->post->id,
            ];


        $this->postJson('/api/comments', $formData)
            ->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->has('success')
                    ->has('data', 10)
                    ->whereAllType([
                        'data.parent_comment_id' => 'integer|null',
                        'data.level' => 'integer',
                        'data.user_name' => 'string',
                        'data.user_email' => 'string|null',
                        'data.content' => 'string',
                        'data.commentable_id' => 'integer',
                        'data.commentable_type' => 'string',
                        'data.created_at' => 'string',
                        'data.updated_at' => 'string',
                    ]);
            });
    }
}
