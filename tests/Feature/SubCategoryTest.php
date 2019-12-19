<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
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
           'admin_id' => $category['admin_id'],
           'category_id' => $category['category_id'],
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 50),
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/subcategory', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('sub_categories', $data);

        $subcategory = SubCategory::all()->first();

        $response->assertJson([
            'data' => [
                'subcategory' => [
                    'name' => $subcategory->name
                ]
            ]
        ]);
    }

    public function test_subcategory_max_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'admin_id' => $category['admin_id'],
           'category_id' => $category['category_id'],
           'name' => $faker->text($maxNbChars = 200),
           'description' => $faker->text($maxNbChars = 200),
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/subcategory', $data);
        $response->assertStatus(422);
    }

    public function test_subcategory_min_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'admin_id' => $category['admin_id'],
           'category_id' => $category['category_id'],
           'name' => 'sd',
           'description' => 'sd',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/subcategory', $data);
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

        $response = $this->json('PUT', "/api/v1/subcategory/{$subcategory['subcategoria_id']}", $update);
        $response->assertStatus(200);

        $subcat = SubCategory::all()->first();

        $this->assertEquals($subcat->name, $update['name']);
    }

    public function test_subcategory_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $this->json('DELETE', "/api/v1/subcategory/{$subcategory['subcategoria_id']}")->assertStatus(204);
        $this->assertNull(SubCategory::find($subcategory['subcategoria_id']));
    }
}
