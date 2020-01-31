<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PhotoSlide;

/**
 * @testdox Accion crear en el modulo de imagenes del slide
 */
class PhotoSlideUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_photo_slide_update() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $update = [
            'configuration_id' => $photoslide['configuration_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 200),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "photoslide/{$photoslide['slide_photo_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox nombre de la imagen similar
     */
    public function test_photo_slide_same_update() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $update = [
            'configuration_id' => $photoslide['configuration_id'],
            'name' => $photoslide['name'],
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "photoslide/{$photoslide['slide_photo_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox no existe la configuracion 
     */
    public function test_photo_slide_no_exist__update() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $update = [
            'configuration_id' => 0,
            'name' => $photoslide['name'],
            'image' => 'slide_default.jpg',
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "photoslide/{$photoslide['slide_photo_id']}", $update);
        $response->assertStatus(422);
    }
}
