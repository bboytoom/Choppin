<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Categorías (Indice)
|
| Descripcion: Muestra la clasificación principal de los artículos que se venden
|--------------------------------------------------------------------------
|
| 1) test_category_update_optimo()
|
| 2) test_category_update_optimo_opcionales()
|
| 3) test_category_update_description_empty()
|
| 4) test_category_same_update()
|
| 5) test_category_update_estatus_deshabilitado()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

/**
 * 
 * @testdox  Como usuario con rol de administrador quiero actualizar una categoría
 * 
 */
class CategoryUpdateTest extends TestCase 
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo
     */
    public function test_category_update_optimo()
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

    /**
     * @testdox Caso optimo sin opcionales
     */
    public function test_category_update_optimo_opcionales()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $response = $this->json('PUT', $this->baseUrl . "categories/{$category['category_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Caso optimo con descripcion vacia
     */
    public function test_category_update_description_empty()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'description' => '',
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $response = $this->json('PUT', $this->baseUrl . "categories/{$category['category_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Nombre similar de la categoria
     */
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

    /**
     * @testdox Categoria con estatus deshabilitado
     */
    public function test_category_update_estatus_deshabilitado()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
           'status' => 0
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $response = $this->json('PUT', $this->baseUrl . "categories/{$category['category_id']}", $update);
        $response->assertStatus(200);
    }
}
