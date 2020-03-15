<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Productos (Indice)
|
| Descripción: Muestra la información de los productos que se venden
| Precondición: Es necesario que la categoría y la subcategoría se hayan creado con anterioridad
|--------------------------------------------------------------------------
|
| 1) test_product_create_optimo()
|
| 2) test_product_create_max_limit_inferior()
|
| 3) test_product_create_max_limit_superior()
|
| 4) test_product_create_min_limit_inferior()
|
| 5) test_product_create_min_limit_superior()
|
| 6) test_product_same_create()
|
| 7) test_product_subcategory_no_exist_create()
|
| 8) test_product_empty_create()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

/**
 * 
 * @testdox Como usuario con rol de administrador quiero crear un nuevo producto para vender
 * 
 */
class ProductCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para crear un producto
     */
    public function test_product_create_optimo()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $complemento = $seed->seed_subcategory();
        $name = 'Producto de prueba';

        $data = [
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => $name,
           'extract' => $faker->text($maxNbChars = 50),
           'description' => $faker->text($maxNbChars = 250),
           'price' => $faker->numberBetween($min = 100, $max = 1000)
        ];

        $response = $this->json('POST', $this->baseUrl . 'products', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('products', [
            'name' => strtolower($name),
        ]);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_product_create_max_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $complemento = $seed->seed_subcategory();

        $data = [
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => 'jksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgndkgnkfjksfjksfnlsngflngk',
           'extract' => 'jksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgndkgnkfjksfjksfnlsngflngk',
           'description' => $faker->text($maxNbChars = 250),
           'price' => 293.50
        ];

        $response = $this->json('POST', $this->baseUrl . 'products', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite superior 
     */
    public function test_product_create_max_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $complemento = $seed->seed_subcategory();

        $data = [
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => 'jksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgndkgnkfjksfjksfnlsngflngksd',
           'extract' => 'jksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklfgndkgnkfjksfjksfnlsngflngklngklfgndkgnkfjksfjksfnlsngflngklfgndkgnkfjksfjksfds',
           'description' => $faker->text($maxNbChars = 250),
           'price' => '3345423'
        ];

        $response = $this->json('POST', $this->baseUrl . 'products', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite inferior 
     */
    public function test_product_create_min_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $complemento = $seed->seed_subcategory();

        $data = [
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => 'sdf',
           'extract' => 'sdf',
           'description' => $faker->text($maxNbChars = 250),
           'price' => $faker->numberBetween($min = 100, $max = 1000)
        ];

        $response = $this->json('POST', $this->baseUrl . 'products', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite superior 
     */
    public function test_product_create_min_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $complemento = $seed->seed_subcategory();

        $data = [
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => 'sddsf',
           'extract' => 'sdsdf',
           'description' => $faker->text($maxNbChars = 250),
           'price' => $faker->numberBetween($min = 100, $max = 1000)
        ];

        $response = $this->json('POST', $this->baseUrl . 'products', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox nombre del producto similar
     */
    public function test_product_same_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $complemento = $seed->seed_product();

        $data = [
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => $complemento['name'],
           'extract' => $faker->text($maxNbChars = 50),
           'description' => $faker->text($maxNbChars = 250),
           'price' => $faker->numberBetween($min = 100, $max = 1000),
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'products', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox No existe la subcategora 
     */
    public function test_product_subcategory_no_exist_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $complemento = $seed->seed_product();

        $data = [
           'subcategory_id' => 0,
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'extract' => $faker->text($maxNbChars = 50),
           'description' => $faker->text($maxNbChars = 250),
           'price' => $faker->numberBetween($min = 100, $max = 1000),
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'products', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox El producto se encuentra vacio
     */
    public function test_product_empty_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $complemento = $seed->seed_subcategory();

        $data = [
           'subcategory_id' => $complemento['subcategoria_id']
        ];

        $response = $this->json('POST', $this->baseUrl . 'products', $data);
        $response->assertStatus(422);
    }
}
