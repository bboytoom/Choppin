<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Características (Indice)
|
| Descripcion: Muestra los detalles de cada producto
| Precondición: Es necesario que el producto se haya creado con anterioridad
|--------------------------------------------------------------------------
|
| 1) test_characteristic_create_optimo()
|
| 2) test_characteristic_create_max_limit_inferior()
|
| 3) test_characteristic_create_max_limit_superior()
|
| 4) test_category_create_min_limit_inferior()
|
| 5) test_category_create_min_limit_superior()
|
| 6) test_characteristic_same_create()
|
| 7) test_characteristic_product_no_exist_create()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Characteristic;

/**
 * @testdox Como usuario con rol de administrador quiero crear una nueva característica para el producto
 */
class CharacteristicCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para crear una caracteristica de producto
     */
    public function test_characteristic_create_optimo()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
           'product_id' => $product['product_id'],
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'products/characteristics', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior
     */
    public function test_characteristic_create_max_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
           'product_id' => $product['product_id'],
           'name' => 'jksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgnsf',
           'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'products/characteristics', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite superior
     */
    public function test_characteristic_create_max_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
           'product_id' => $product['product_id'],
           'name' => 'jksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgnsfdf',
           'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'products/characteristics', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite inferior 
     */
    public function test_characteristic_create_min_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
           'product_id' => $product['product_id'],
           'name' => 'df',
           'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'products/characteristics', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite superior 
     */
    public function test_characteristic_create_min_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
           'product_id' => $product['product_id'],
           'name' => 'dfdd',
           'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'products/characteristics', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox El nombre de la categoría debe ser único
     */
    public function test_characteristic_same_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $data = [
           'product_id' => $characteristic['product_id'],
           'name' => $characteristic['name'],
           'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'products/characteristics', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox El id del producto no existe
     */
    public function test_characteristic_product_no_exist_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        
        $data = [
           'product_id' => 0,
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 250)
        ];

        $response = $this->json('POST', $this->baseUrl . 'products/characteristics', $data);
        $response->assertStatus(422);
    }
}
