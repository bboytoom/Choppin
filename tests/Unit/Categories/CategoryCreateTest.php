<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Categorías (Indice)
|
| Descripcion: Muestra la clasificación principal de los artículos que se venden
|--------------------------------------------------------------------------
|
| 1) test_category_create_optimo()
|
| 2) test_category_create_optimo_opcional()
|
| 3) test_category_create_max_limit_inferior()
|
| 4) test_category_create_max_limit_superior()
|
| 5) test_category_create_min_limit_inferior()
|
| 6) test_category_create_min_limit_superior()
|
| 7) test_category_same_name()
|
| 8) test_category_empty_create()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @testdox Como usuario con rol de administrador quiero crear una nueva categoría para tener una nueva sección en mi tienda
 */
class CategoryCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para crear una categoria
     */
    public function test_category_create_optimo()
    {
        $faker = \Faker\Factory::create();
        $name = $faker->unique()->sentence($nbWords = 2, $variableNbWords = true);
        
        $data = [
           'name' => $name,
           'description' => $faker->text($maxNbChars = 50)
        ];

        $response = $this->json('POST', $this->baseUrl . 'categories', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('categories', [
            'name' => strtolower($name),
        ]);
    }

    /**
     * @testdox La descripción es opcional
     */
    public function test_category_create_optimo_opcional()
    {
        $faker = \Faker\Factory::create();
        
        $data = [
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => ''
        ];

        $response = $this->json('POST', $this->baseUrl . 'categories', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('categories', [
            'description' => '',
        ]);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_category_create_max_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        
        $data = [
            'name' => 'jksfnlsngflngklfgndkgnkfjksf'
        ];

        $response = $this->json('POST', $this->baseUrl . 'categories', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite superior 
     */
    public function test_category_create_max_limit_superior()
    {
        $faker = \Faker\Factory::create();
        
        $data = [
            'name' => 'jksfnlsngflngklfgndkgnkfjksfsd'
        ];

        $response = $this->json('POST', $this->baseUrl . 'categories', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite inferior 
     */
    public function test_category_create_min_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        
        $data = [
            'name' => 'dfg'
        ];

        $response = $this->json('POST', $this->baseUrl . 'categories', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite superior 
     */
    public function test_category_create_min_limit_superior()
    {
        $faker = \Faker\Factory::create();
        
        $data = [
            'name' => 'dffsd'
        ];

        $response = $this->json('POST', $this->baseUrl . 'categories', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox El nombre de la categoría debe ser único
     */
    public function test_category_same_name()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'name' => $category['name'],
           'description' => $faker->text($maxNbChars = 50)
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
