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
class PhotoSlideCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_photo_slide_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $data = [
            'configuration_id' => $configuration['configuration_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photoslide', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox nombre de la imagen similar
     */
    public function test_photo_slide_same_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $data = [
            'configuration_id' => $photoslide['configuration_id'],
            'name' => $photoslide['name'],
            'image' => 'slide_default.jpg',
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photoslide', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox no existe la configuracion 
     */
    public function test_photo_slide_no_exist_create() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();

        $data = [
            'configuration_id' => 0,
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.jpg',
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photoslide', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox no cuenta con el minimo de caracteres requeridos
     */
    public function test_photo_slide_min_field_create() 
    {
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $data = [
            'configuration_id' => $configuration['configuration_id'],
            'name' => 'd',
            'image' => 'slide_default.jpg',
            'description' => 'd',
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photoslide', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox sobrepasa los caracteres requeridos
     */
    public function test_photo_slide_max_field_create() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $data = [
            'configuration_id' => $configuration['configuration_id'],
            'name' => $faker->unique()->sentence($nbWords = 100, $variableNbWords = true),
            'image' => $faker->text($maxNbChars = 350),
            'description' => $faker->text($maxNbChars = 350),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photoslide', $data);
        $response->assertStatus(422);
    }
}
