<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PhotoGallery;

/**
 * @testdox Accion crear en el modulo de imagen de la galeria
 */
class PhotoGalleryCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_photo_gallery_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $data = [
            'gallery_id' => $gallery['gallery_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photosgalleries', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox nombre de la imagen similar
     */
    public function test_photo_gallery_same_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photogallery = $seed->seed_gallery_photo();

        $data = [
            'gallery_id' => $photogallery['gallery_id'],
            'name' => $photogallery['name'],
            'image' => 'slide_default.jpg',
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photosgalleries', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox no existe la galeria 
     */
    public function test_photo_gallery_no_exist_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();

        $data = [
            'gallery_id' => 0,
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.jpg',
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photosgalleries', $data);
        $response->assertStatus(422);
    }
    
    /**
     * @testdox no cuenta con el minimo de caracteres requeridos
     */
    public function test_photo_gallery_min_field_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $data = [
            'gallery_id' => $gallery['gallery_id'],
            'name' => 'd',
            'image' => 'slide_default.jpg',
            'description' => 'd',
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photosgalleries', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox sobrepasa los caracteres requeridos
     */
    public function test_photo_gallery_max_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $data = [
            'gallery_id' => $gallery['gallery_id'],
            'name' => $faker->unique()->sentence($nbWords = 100, $variableNbWords = true),
            'image' => $faker->text($maxNbChars = 350),
            'description' => $faker->text($maxNbChars = 350),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photosgalleries', $data);
        $response->assertStatus(422);
    }
}
