<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Categorías (Indice)
|
| Descripcion: Muestra la información de la sub clasificación de los artículos que se venden
| Precondición: Es necesario que la categoría se haya creado con anterioridad
|--------------------------------------------------------------------------
|
| 1) test_subcategory_create_optimo()
|
| 2) test_subcategory_create_optimo_opcional()
|
| 3) test_subcategory_create_max_limit_inferior()
|
| 4) test_subcategory_create_max_limit_superior()
|
| 5) test_subcategory_create_min_limit_inferior()
|
| 6) test_subcategory_create_min_limit_superior()
|
| 7) test_subcategory_same_create()
|
| 8) test_subcategory_category_no_exist_create()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SubCategory;

/**
 * 
 * @testdox Como usuario con rol de administrador quiero crear una nueva subcategoría para tener una nueva sección en mi tienda
 * 
 */
class SubCategoryCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para crear una subcategoria
     */
    public function test_subcategory_create_optimo()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'category_id' => $category['category_id'],
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => $faker->text($maxNbChars = 50)
        ];

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox La descripción es opcional
     */
    public function test_subcategory_create_optimo_opcional()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'category_id' => $category['category_id'],
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true)
        ];

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_subcategory_create_max_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'category_id' => $category['category_id'],
           'name' => 'jksfnlsngflngklfgndkgnkfjksf'
        ];

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite superior 
     */
    public function test_subcategory_create_max_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'category_id' => $category['category_id'],
           'name' => 'jksfnlsngflngklfgndkgnkfjksfks'
        ];

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite inferior 
     */
    public function test_subcategory_create_min_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'category_id' => $category['category_id'],
           'name' => 'dfg'
        ];

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite inferior 
     */
    public function test_subcategory_create_min_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
           'category_id' => $category['category_id'],
           'name' => 'dffsd'
        ];

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox El nombre de la categoría debe ser único
     */
    public function test_subcategory_same_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $data = [
           'category_id' => $subcategory['category_id'],
           'name' => $subcategory['name'],
           'description' => $faker->text($maxNbChars = 50)
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
           'description' => $faker->text($maxNbChars = 50)
        ];

        $response = $this->json('POST', $this->baseUrl . 'subcategories', $data);
        $response->assertStatus(422);
    }
}
