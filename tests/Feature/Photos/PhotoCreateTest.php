<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Imágenes del producto (Indice)
|
| Descripcion: Muestra las imágenes de los productos
| Precondición: Es necesario que el producto se haya creado con anterioridad
|--------------------------------------------------------------------------
|
| 1) test_photo_create_optimo()
|
| 2) test_photo_create_max_limit_inferior()
|
| 3) test_photo_create_max_limit_superior()
|
| 4) test_photo_create_min_limit_inferior()
|
| 5) test_photo_create_min_limit_superior()
|
| 6) test_photo_same_create()
|
| 7) test_photo_product_no_exist_create()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Photo;

/**
 * @testdox Como usuario con rol de administrador quiero agregar una nueva imagen para el producto
 */
class PhotoCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para crear una imagen de producto
     */
    public function test_photo_create_optimo()
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

        $response = $this->json('POST', $this->baseUrl . 'products/photos', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior
     */
    public function test_photo_create_max_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
            'product_id' => $product['product_id'],
            'name' => 'jksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgnsfjksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgnsfdd',
            'image' => 'sdssfsflngklfgnsfjksfnlsngflproducto_default.png',
            'type' => 'image/png',
            'base' => create_image_producto(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'products/photos', $data);
        $response->assertStatus(201);
    }    

    /**
     * @testdox Maximo numero de caracteres con limite superior
     */
    public function test_photo_create_max_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
            'product_id' => $product['product_id'],
            'name' => 'jksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgnsfjksfnlsngflngklfgdsndkgnkfjksfjksfnlsngflngklfgnsfdd',
            'image' => 'sdssfsflngklfgnsfjksfnlsngflprdsoducto_default.png',
            'type' => 'image/png',
            'base' => create_image_producto(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'products/photos', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite inferior
     */
    public function test_photo_create_min_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
            'product_id' => $product['product_id'],
            'name' => 'sd',
            'image' => 's.png',
            'type' => 'image/png',
            'base' => create_image_producto(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'products/photos', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite superior
     */
    public function test_photo_create_min_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
            'product_id' => $product['product_id'],
            'name' => 'sddf',
            'image' => 'dss.png',
            'type' => 'image/png',
            'base' => create_image_producto(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'products/photos', $data);
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

        $response = $this->json('POST', $this->baseUrl . 'products/photos', $data);
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

        $response = $this->json('POST', $this->baseUrl . 'products/photos', $data);
        $response->assertStatus(422);
    }
}
