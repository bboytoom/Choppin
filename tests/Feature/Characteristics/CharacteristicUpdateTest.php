<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Characteristic;

/**
 * @testdox Accion actualizar en el modulo de caracteristicas del producto
 */
class CharacteristicUpdateTest extends TestCase 
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_characteristic_update()
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

        $response = $this->json('PUT', $this->baseUrl . "characteristics/{$characteristic['characteristic_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox el nombre de la caracteristica es similar
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

        $response = $this->json('PUT', $this->baseUrl . "characteristics/{$characteristic['characteristic_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox el id del producto no existe
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

        $response = $this->json('PUT', $this->baseUrl . "characteristics/{$characteristic['characteristic_id']}", $update);
        $response->assertStatus(422);
    }
}
