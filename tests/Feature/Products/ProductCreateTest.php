<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\Product;

class ProductCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_product_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $complemento = $seed->seed_subcategory();

        $data = [
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'extract' => $faker->text($maxNbChars = 50),
           'description' => $faker->text($maxNbChars = 250),
           'price' => $faker->numberBetween($min = 100, $max = 1000),
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'products', $data);
        $response->assertStatus(201);
    }

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

    public function test_product_min_field_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $complemento = $seed->seed_subcategory();

        $data = [
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => 'producto',
           'extract' => 'Lor',
           'description' => 'Lre.',
           'price' => '12.50',
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'products', $data);
        $response->assertStatus(422);
    }

    public function test_product_max_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $complemento = $seed->seed_subcategory();

        $data = [
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => $faker->text($maxNbChars = 200),
           'extract' => $faker->text($maxNbChars = 200),
           'description' => $faker->text($maxNbChars = 200),
           'price' => $faker->numberBetween($min = 100, $max = 1000),
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'products', $data);
        $response->assertStatus(422);
    }
}
