<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Characteristic;

class CharacteristicTest extends TestCase
{
    use RefreshDatabase;

    public function test_characteristic_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
           'product_id' => $product['product_id'],
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 250),
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/characteristics', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('characteristics', $data);

        $characteristics = Characteristic::all()->first();

        $response->assertJson([
            'data' => [
                'characteristics' => [
                    'name' => $characteristics->name
                ]
            ]
        ]);
    }

    public function test_characteristic_same_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $data = [
           'product_id' => $characteristic['product_id'],
           'name' => $characteristic['name'],
           'description' => $faker->text($maxNbChars = 250),
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/characteristics', $data);
        $response->assertStatus(422);
    }

    public function test_characteristic_product_no_exist_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $data = [
           'product_id' => 0,
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 250),
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/characteristics', $data);
        $response->assertStatus(422);
    }

    public function test_characteristic_min_field_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
           'product_id' => $product['product_id'],
           'name' => 's',
           'description' => 's',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/characteristics', $data);
        $response->assertStatus(422);
    }

    public function test_characteristic_max_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
           'product_id' => $product['product_id'],
           'name' => $faker->unique()->sentence($nbWords = 50, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 200),
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/characteristics', $data);
        $response->assertStatus(422);
    }

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

        $response = $this->json('PUT', "/api/v1/characteristics/{$characteristic['characteristic_id']}", $update);
        $response->assertStatus(200);

        $caract = Characteristic::all()->first();

        $this->assertEquals($caract->name, $update['name']);
    }

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

        $response = $this->json('PUT', "/api/v1/characteristics/{$characteristic['characteristic_id']}", $update);
        $response->assertStatus(200);
    }

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

        $response = $this->json('PUT', "/api/v1/characteristics/{$characteristic['characteristic_id']}", $update);
        $response->assertStatus(422);
    }

    public function test_characteristic_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $this->json('DELETE', "/api/v1/characteristics/{$characteristic['characteristic_id']}")->assertStatus(204);
        $this->assertNull(Characteristic::find($characteristic['characteristic_id']));
    }
}
