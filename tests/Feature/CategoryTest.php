<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        
        $data = [
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 50),
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/categories', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_category_same_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'name' => $category['name'],
           'description' => $faker->text($maxNbChars = 50),
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/categories', $data);
        $response->assertStatus(422);
    }

    public function test_category_max_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        
        $data = [
            'name' => $faker->text($maxNbChars = 260),
            'description' => $faker->text($maxNbChars = 260),
            'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/categories', $data);
        $response->assertStatus(422);
    }

    public function test_category_min_field_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        
        $data = [
            'name' => 'a',
            'description' => 's',
            'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/categories', $data);
        $response->assertStatus(422);
    }

    public function test_category_empty_create()
    {
        $data = [];

        $response = $this->json('POST', '/api/v1/categories', $data);
        $response->assertStatus(422);
    }

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

        $response = $this->json('PUT', "/api/v1/categories/{$category['category_id']}", $update);
        $response->assertStatus(200);

        $cate = Category::all()->first();
        
        $this->assertEquals($cate->name, $update['name']);
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

        $response = $this->json('PUT', "/api/v1/categories/{$category['category_id']}", $update);
        $response->assertStatus(200);
    }

    public function test_category_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $this->json('DELETE', "/api/v1/categories/{$category['category_id']}")->assertStatus(204);
        $this->assertNull(Category::find($category['category_id']));
    }
}
