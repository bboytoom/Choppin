<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SubCategory;

class SubCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_subcategory_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'category_id' => $category['category_id'],
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 50),
           'status' => 1
        ];

        $response = $this->withHeaders([
            'x-api-key' => config('app.key'),
        ])->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(201);
    }

    public function test_subcategory_same_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $data = [
           'category_id' => $subcategory['category_id'],
           'name' => $subcategory['name'],
           'description' => $faker->text($maxNbChars = 50),
           'status' => 1
        ];

        $response = $this->withHeaders([
            'x-api-key' => config('app.key'),
        ])->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(422);
    }

    public function test_subcategory_category_no_exist_create()
    {
        $faker = \Faker\Factory::create();
        
        $data = [
           'category_id' => 0,
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 50),
           'status' => 1
        ];

        $response = $this->withHeaders([
            'x-api-key' => config('app.key'),
        ])->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(422);
    }

    public function test_subcategory_max_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'category_id' => $category['category_id'],
           'name' => $faker->text($maxNbChars = 200),
           'description' => $faker->text($maxNbChars = 200),
           'status' => 1
        ];

        $response = $this->withHeaders([
            'x-api-key' => config('app.key'),
        ])->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(422);
    }

    public function test_subcategory_min_field_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'category_id' => $category['category_id'],
           'name' => 'sd',
           'description' => 'sd',
           'status' => 1
        ];

        $response = $this->withHeaders([
            'x-api-key' => config('app.key'),
        ])->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(422);
    }

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

        $response = $this->withHeaders([
            'x-api-key' => config('app.key'),
        ])->json('PUT', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}", $update);
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

        $response = $this->withHeaders([
            'x-api-key' => config('app.key'),
        ])->json('PUT', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}", $update);
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

        $response = $this->withHeaders([
            'x-api-key' => config('app.key'),
        ])->json('PUT', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}", $update);
        $response->assertStatus(422);
    }

    public function test_subcategory_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $this->withHeaders([
            'x-api-key' => config('app.key'),
        ])->json('DELETE', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}")->assertStatus(204);
        $this->assertNull(SubCategory::find($subcategory['subcategoria_id']));
    }
}
