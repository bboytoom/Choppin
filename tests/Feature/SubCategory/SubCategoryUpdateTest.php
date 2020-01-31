<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SubCategory;

class SubCategoryUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_subcategory_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $update = [
            'category_id' => $subcategory['category_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'description' => $faker->text($maxNbChars = 50),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}", $update);
        $response->assertStatus(200);
    }

    public function test_subcategory_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $update = [
            'category_id' => $subcategory['category_id'],
            'name' => $subcategory['name'],
            'description' => $faker->text($maxNbChars = 50),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}", $update);
        $response->assertStatus(200);
    }

    public function test_subcategory_category_no_exist_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $update = [
            'category_id' => 0,
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'description' => $faker->text($maxNbChars = 50),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}", $update);
        $response->assertStatus(422);
    }
}
