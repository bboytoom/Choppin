<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Photo;

/**
 * @testdox Accion actualizar en el modulo de imagenes del producto
 */
class PhotoUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_photo_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photo = $seed->seed_photo();

        $update = [
            'product_id' => $photo['product_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'producto_default.png',
            'type' => 'image/png',
            'base' => create_image_producto(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "photos/{$photo['photo_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox nombre de la imagen similar
     */
    public function test_photo_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photo = $seed->seed_photo();

        $update = [
            'product_id' => $photo['product_id'],
            'name' => $photo['name'],
            'image' => 'producto_default.png',
            'type' => 'image/png',
            'base' => create_image_producto(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];
        
        $response = $this->json('PUT', $this->baseUrl . "photos/{$photo['photo_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox no existe el producto 
     */
    public function test_photo_same_product_no_exist_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photo = $seed->seed_photo();

        $update = [
            'product_id' => 0,
            'name' => $photo['name'],
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "photos/{$photo['photo_id']}", $update);
        $response->assertStatus(422);
    }
}
