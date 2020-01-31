<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryUpdateTest extends TestCase 
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_category_update()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 50),
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $response = $this->json('PUT', $this->baseUrl . "categories/{$category['category_id']}", $update);
        $response->assertStatus(200);
    }

    public function test_category_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();

        $category = $seed->seed_category();

        $update = [
           'name' => $category['name'],
           'description' => $faker->text($maxNbChars = 50),
           'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "categories/{$category['category_id']}", $update);
        $response->assertStatus(200);
    }
}
