<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Productos (Indice)
|
| Descripción: Muestra la información de los productos que se venden
| Precondición: Es necesario que la categoría y la subcategoría se hayan creado con anterioridad
|--------------------------------------------------------------------------
|
| 1) test_product_update_optimo()
|
| 2) test_product_same_update()
|
| 3) test_product_subcategory_no_exist_update()
|
| 4) test_product_update_estatus_deshabilitado()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\Product;

/**
 * @testdox Como usuario con rol de administrador quiero actualizar la información de un producto
 */
class ProductUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_product_update_optimo()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $update = [
            'subcategory_id' => $product['subcategoria_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'extract' => $faker->text($maxNbChars = 50),
            'description' => $faker->text($maxNbChars = 250),
            'price' => $faker->numberBetween($min = 100, $max = 1000),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "products/{$product['product_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Nombre del producto similar
     */
    public function test_product_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $update = [
            'subcategory_id' => $product['subcategoria_id'],
            'name' => $product['name'],
            'extract' => $faker->text($maxNbChars = 50),
            'description' => $faker->text($maxNbChars = 250),
            'price' => $faker->numberBetween($min = 100, $max = 1000),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "products/{$product['product_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox No existe la subcategoria 
     */
    public function test_product_subcategory_no_exist_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $update = [
            'subcategory_id' => 0,
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'extract' => $faker->text($maxNbChars = 50),
            'description' => $faker->text($maxNbChars = 250),
            'price' => $faker->numberBetween($min = 100, $max = 1000),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "products/{$product['product_id']}", $update);
        $response->assertStatus(422);
    }

    /**
     * @testdox Categoria con estatus deshabilitado
     */
    public function test_product_update_estatus_deshabilitado()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $update = [
            'subcategory_id' => $product['subcategoria_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'extract' => $faker->text($maxNbChars = 50),
            'description' => $faker->text($maxNbChars = 250),
            'price' => $faker->numberBetween($min = 100, $max = 1000),
            'status' => 0
        ];

        $response = $this->json('PUT', $this->baseUrl . "products/{$product['product_id']}", $update);
        $response->assertStatus(200);
    }
}
