<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Gallery;

class GalleryTest extends TestCase
{
    use RefreshDatabase;

    public function test_gallery_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
            'category_id' => $category['category_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'active' => 1,
            'status' => 1
        ];

        $response = $this->withHeaders([
            'APP_KEY' => config('app.key'),
        ])->json('POST', '/api/v1/galleries', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('galleries', $data);
    }

    public function test_gallery_same_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $data = [
            'category_id' => $gallery['category_id'],
            'name' => $gallery['name'],
            'active' => 1,
            'status' => 1
        ];

        $response = $this->withHeaders([
            'APP_KEY' => config('app.key'),
        ])->json('POST', '/api/v1/galleries', $data);
        $response->assertStatus(422);
    }

    public function test_gallery_category_no_exist_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'category_id' => 0,
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'active' => 1,
            'status' => 1
        ];

        $response = $this->withHeaders([
            'APP_KEY' => config('app.key'),
        ])->json('POST', '/api/v1/galleries', $data);
        $response->assertStatus(422);
    }

    public function test_gallery_max_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
            'category_id' => $category['category_id'],
            'name' => $faker->text($maxNbChars = 200),
            'active' => 1,
            'status' => 1
        ];

        $response = $this->withHeaders([
            'APP_KEY' => config('app.key'),
        ])->json('POST', '/api/v1/galleries', $data);
        $response->assertStatus(422);
    }

    public function test_gallery_min_field_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
            'category_id' => $category['category_id'],
            'name' => 's',
            'active' => 1,
            'status' => 1
        ];

        $response = $this->withHeaders([
            'APP_KEY' => config('app.key'),
        ])->json('POST', '/api/v1/galleries', $data);
        $response->assertStatus(422);
    }

    public function test_gallery_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $update = [
            'category_id' => $gallery['category_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'active' => 1,
            'status' => 1
        ];

        $response = $this->withHeaders([
            'APP_KEY' => config('app.key'),
        ])->json('PUT', "/api/v1/galleries/{$gallery['gallery_id']}", $update);
        $response->assertStatus(200);
    }

    public function test_gallery_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $update = [
            'category_id' => $gallery['category_id'],
            'name' => $gallery['name'],
            'active' => 1,
            'status' => 1
        ];

        $response = $this->withHeaders([
            'APP_KEY' => config('app.key'),
        ])->json('PUT', "/api/v1/galleries/{$gallery['gallery_id']}", $update);
        $response->assertStatus(200);
    }

    public function test_gallery_category_no_exist_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $update = [
            'category_id' => 0,
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'active' => 1,
            'status' => 1
        ];

        $response = $this->withHeaders([
            'APP_KEY' => config('app.key'),
        ])->json('PUT', "/api/v1/galleries/{$gallery['gallery_id']}", $update);
        $response->assertStatus(200);
    }

    public function test_gallery_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $this->withHeaders([
            'APP_KEY' => config('app.key'),
        ])->json('DELETE', "/api/v1/galleries/{$gallery['gallery_id']}")->assertStatus(204);
        $this->assertNull(Gallery::find($gallery['gallery_id']));
    }
}
