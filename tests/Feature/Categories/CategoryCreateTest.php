<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

/**
 * @testdox Accion crear en el modulo de categorias
 */
class CategoryCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_category_create()
    {
        $faker = \Faker\Factory::create();
        
        $data = [
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 50),
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'categories', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Nombre de la categoria similar
     */
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

        $response = $this->json('POST', $this->baseUrl . 'categories', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Sobrepasa el tamaño reuerido
     */
    public function test_category_max_field_create()
    {
        $faker = \Faker\Factory::create();
        
        $data = [
            'name' => $faker->text($maxNbChars = 260),
            'description' => $faker->text($maxNbChars = 260),
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'categories', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox No cuenta con el minimo de caracteres minimos
     */
    public function test_category_min_field_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        
        $data = [
            'name' => 'a',
            'description' => 's',
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'categories', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Parametros vacios
     */
    public function test_category_empty_create()
    {
        $data = [];

        $response = $this->json('POST', $this->baseUrl . 'categories', $data);
        $response->assertStatus(422);
    }
}
