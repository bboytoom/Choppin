<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Slide principal (Indice)
|
| Descripcion: Muestra las imágenes que utilizan al inicio de la tienda
| Precondición: Es necesario que exista la configuración de la tienda
|--------------------------------------------------------------------------
|
| 1) test_photo_slide_create_optimo()
|
| 2) test_photo_slide_create_optimo_opcional()
|
| 3) test_photo_slide_create_max_limit_inferior()
|
| 4) test_photo_slide_create_max_limit_superior()
|
| 5) test_photo_slide_create_min_limit_inferior()
|
| 6) test_photo_slide_create_min_limit_superior()
|
| 7) test_photo_slide_same_create()
|
| 8) test_photo_slide_no_exist_create() 
|
*/

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
     * @testdox Caso optimo para agregar una imagen al slide principal
     */
    public function test_photo_slide_create_optimo()
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
            'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'configurations/slide', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox La descripción es opcional
     */
    public function test_photo_slide_create_optimo_opcional()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $data = [
            'configuration_id' => $configuration['configuration_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide()
        ];

        $response = $this->json('POST', $this->baseUrl . 'configurations/slide', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_photo_slide_create_max_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $data = [
            'configuration_id' => $configuration['configuration_id'],
            'name' => 'jksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgnsfjksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgnsfdd',
            'image' => 'sdssfsflngklfgnsfjksfnlsngflproducto_default.png',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'configurations/slide', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite superior 
     */
    public function test_photo_slide_create_max_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $data = [
            'configuration_id' => $configuration['configuration_id'],
            'name' => 'jksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgnsfjksfnlsngflngklfgdsndkgnkfjksfjksfnlsngflngklfgnsfdd',
            'image' => 'sdssfsflngklfgnsfjksfnlsngflprdsoducto_default.png',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'configurations/slide', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite inferior
     */
    public function test_photo_slide_create_min_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $data = [
            'configuration_id' => $configuration['configuration_id'],
            'name' => 'sg',
            'image' => 's.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'configurations/slide', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite superior
     */
    public function test_photo_slide_create_min_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $data = [
            'configuration_id' => $configuration['configuration_id'],
            'name' => 'sgsd',
            'image' => 'dds.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'configurations/slide', $data);
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

        $response = $this->json('POST', $this->baseUrl . 'configurations/slide', $data);
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

        $response = $this->json('POST', $this->baseUrl . 'configurations/slide', $data);
        $response->assertStatus(422);
    }
}
