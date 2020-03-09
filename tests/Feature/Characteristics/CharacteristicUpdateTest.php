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
| 1) test_characteristic_update_optimo()
|
| 2) test_characteristic_same_update()
|
| 3) test_characteristic_product_no_exist_update()
|
| 4) test_characteristic_estatus_deshabilitado()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Characteristic;

/**
 * @testdox Como usuario con rol de administrador quiero actualizar una característica
 */
class CharacteristicUpdateTest extends TestCase 
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo
     */
    public function test_characteristic_update_optimo()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $update = [
            'product_id' => $characteristic['product_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "products/characteristics/{$characteristic['characteristic_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox El nombre de la caracteristica es similar
     */
    public function test_characteristic_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();
        
        $update = [
            'product_id' => $characteristic['product_id'],
            'name' => $characteristic['name'],
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "products/characteristics/{$characteristic['characteristic_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox El id del producto no existe
     */
    public function test_characteristic_product_no_exist_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();
        
        $update = [
            'product_id' => 0,
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "products/characteristics/{$characteristic['characteristic_id']}", $update);
        $response->assertStatus(422);
    }

    /**
     * @testdox Caracteristica con estatus deshabilitado
     */
    public function test_characteristic_estatus_deshabilitado()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $update = [
            'product_id' => $characteristic['product_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 0
        ];

        $response = $this->json('PUT', $this->baseUrl . "products/characteristics/{$characteristic['characteristic_id']}", $update);
        $response->assertStatus(200);
    }
}
