<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Photo;

/**
 * @testdox Accion crear en el modulo de imagenes del producto
 */
class PhotoCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_photo_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
            'product_id' => $product['product_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'producto_default.png',
            'type' => 'image/png',
            'base' => create_image_producto(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photos', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox nombre de la galeria similar
     */
    public function test_photo_same_create() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photo = $seed->seed_photo();

        $data = [
            'product_id' => $photo['product_id'],
            'name' => $photo['name'],
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photos', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox no existe la categoria 
     */
    public function test_photo_product_no_exist_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();

        $data = [
            'product_id' => 0,
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'producto_default.png',
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photos', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox no cuenta con el minimo de caracteres requeridos
     */
    public function test_photo_min_field_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
            'product_id' => $product['product_id'],
            'name' => 's',
            'image' => 'a',
            'description' => 's',
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photos', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox sobrepasa los caracteres requeridos
     */
    public function test_photo_max_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
            'product_id' => $product['product_id'],
            'name' => $faker->unique()->sentence($nbWords = 100, $variableNbWords = true),
            'image' => $faker->text($maxNbChars = 350),
            'description' => $faker->text($maxNbChars = 350),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'photos', $data);
        $response->assertStatus(422);
    }
}
