<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\Product;

class ProductUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_product_update()
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
}
