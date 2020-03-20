<?php

namespace Tests\Feature;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test **/
    public function user_can_add_like_to_post()
    {
        $this->loginAsApi();

        $post = factory(Post::class)->create();

        $this->assertCount(0, $post->likes);

        $this->postJson(route('api.likes.store'), [
            'type' => 'post',
            'id' => $post->getKey(),
        ])
            ->assertCreated();

        $this->assertCount(1, $post->fresh()->likes);
    }

    /** @test **/
    public function user_can_remove_like_to_post()
    {
        $user = $this->loginAsApi();

        $post = factory(Post::class)->create();

        $like = factory(Like::class)->create([
            'user_id' => $user->getKey(),
            'likeable_id' => $post->getKey(),
            'likeable_type' => $post->getMorphClass()
        ]);

        $this->assertCount(1, $post->likes);

        $this->deleteJson(route('api.likes.destroy', [
            'like' => $like,
        ]))
            ->assertSuccessful();

        $this->assertCount(0, $post->fresh()->likes);
    }
}
