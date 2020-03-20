<?php

namespace Tests\Feature;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test **/
    public function guest_can_not_store_image(): void
    {
        $this->postJson(route('api.images.store'))
            ->assertUnauthorized();
    }

    /** @test * */
    public function user_can_not_store_image_with_bad_credentials(): void
    {
        $this->loginAsApi();

        $this->postJson(route('api.images.store'))
            ->assertJsonValidationErrors([
                'file', 'title'
            ]);
    }

    /** @test **/
    public function user_can_store_image()
    {
        Storage::fake('local');

        $file = UploadedFile::fake()->image('image.jpg');

        $user = $this->loginAsApi();

        $response = $this->postJson(route('api.images.store'), [
            'file' => $file,
            'title' => $title = $this->faker->sentence,
        ])
            ->assertCreated();

        Storage::disk('local')->assertExists($response->json('data.path'));

        $this->assertDatabaseHas((new Image)->getTable(), [
            'user_id' => $user->getKey(),
            'title' => $title,
        ]);
    }

    /** @test **/
    public function user_can_update_image()
    {
        $user = $this->loginAsApi();

        $image = factory(Image::class)->create([
            'user_id' => $user->getKey(),
        ]);

        $this->patchJson(route('api.images.update', [
            'image' => $image,
        ]), [
            'title' => $newTitle = $this->faker->sentence,
        ])
            ->assertSuccessful();

        $this->assertDatabaseHas((new Image)->getTable(), [
            'id' => $image->getKey(),
            'title' => $newTitle,
        ]);
    }
}
