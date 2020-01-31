<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SubCategory;

/**
 * @testdox Accion actualizar en el modulo de subcateria
 */
class SubCategoryCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
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

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox nombre de la subcategoria similar
     */
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

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox no existe la categoria 
     */
    public function test_subcategory_category_no_exist_create()
    {
        $faker = \Faker\Factory::create();
        
        $data = [
           'category_id' => 0,
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 50),
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox sobrepasa los caracteres requeridos
     */
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

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox no cuenta con el minimo de caracteres requeridos
     */
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

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(422);
    }
}
