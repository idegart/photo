<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test **/
    public function guest_can_not_create_post(): void
    {
        $this->postJson(route('api.posts.store'))
            ->assertUnauthorized();
    }

    /** @test * */
    public function user_can_not_store_post_with_bad_credentials(): void
    {
        $this->loginAsApi();

        $this->postJson(route('api.posts.store'))
            ->assertJsonValidationErrors([
                'title', 'text'
            ]);
    }

    /** @test * */
    public function user_can_store_post(): void
    {
        $user = $this->loginAsApi();

        $this->postJson(route('api.posts.store'), [
            'title' => $title = $this->faker->sentence,
            'text' => $text = $this->faker->paragraph,
        ])
            ->assertCreated();

        $this->assertDatabaseHas((new Post)->getTable(), [
            'user_id' => $user->getKey(),
            'title' => $title,
            'text' => $text,
        ]);
    }

    /** @test **/
    public function user_can_update_post(): void
    {
        $user = $this->loginAsApi();

        $post = factory(Post::class)->create([
            'user_id' => $user->getKey(),
        ]);

        $this->patchJson(route('api.posts.update', [
            'post' => $post,
        ]), [
            'title' => $title = $this->faker->sentence,
            'text' => $text = $this->faker->paragraph,
        ])
            ->dump()
            ->assertSuccessful();

        $this->assertDatabaseHas((new Post)->getTable(), [
            'user_id' => $user->getKey(),
            'title' => $title,
            'text' => $text,
        ]);
    }

    /** @test **/
    public function user_can_delete_post(): void
    {
        $user = $this->loginAsApi();

        $post = factory(Post::class)->create([
            'user_id' => $user->getKey(),
        ]);

        $this->deleteJson(route('api.posts.update', [
            'post' => $post,
        ]))
            ->assertSuccessful();

        $this->assertDatabaseMissing((new Post)->getTable(), [
            'id' => $post->getKey(),
        ]);
    }

}
