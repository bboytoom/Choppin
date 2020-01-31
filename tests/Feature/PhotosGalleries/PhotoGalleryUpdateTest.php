<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PhotoGallery;

/**
 * @testdox Accion actualizar en el modulo de imagenes de la galeria
 */
class PhotoGalleryUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_photo_gallery_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photogallery = $seed->seed_gallery_photo();

        $update = [
            'gallery_id' => $photogallery['gallery_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "photosgalleries/{$photogallery['gallery_photo_id']}", $update);
        $response->assertStatus(200);
    }

    public function test_photo_gallery_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photogallery = $seed->seed_gallery_photo();

        $update = [
            'gallery_id' => $photogallery['gallery_id'],
            'name' => $photogallery['name'],
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 200),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "photosgalleries/{$photogallery['gallery_photo_id']}", $update);
        $response->assertStatus(200);
    }

    public function test_photo_gallery_no_exist__update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photogallery = $seed->seed_gallery_photo();

        $update = [
            'gallery_id' => 0,
            'name' => $photogallery['name'],
            'image' => 'slide_default.jpg',
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "photosgalleries/{$photogallery['gallery_photo_id']}", $update);
        $response->assertStatus(422);
    }
}
