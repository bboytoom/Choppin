<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Categorías (Indice)
|
| Descripcion: Muestra la clasificación principal de los artículos que se venden
|--------------------------------------------------------------------------
|
| 1) test_subcategory_update_optimo()
|
| 2) test_subcategory_update_optimo_opcionales()
|
| 3) test_subcategory_update_description_empty()
|
| 4) test_subcategory_same_update()
|
| 5) test_subcategory_category_no_exist_update()
|
| 6) test_subcategory_estatus_deshabilitado()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * 
 * @testdox Como usuario con rol de administrador quiero actualizar la subcategoria.
 * 
 */
class SubCategoryUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo
     */
    public function test_subcategory_update_optimo()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();
        $name = $faker->unique()->sentence($nbWords = 2, $variableNbWords = true);

        $update = [
            'category_id' => $subcategory['category_id'],
            'name' => $name,
            'description' => $faker->text($maxNbChars = 50),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}", $update);
        $response->assertStatus(200);

        $this->assertDatabaseHas('sub_categories', [
            'name' => strtolower($name)
        ]);
    }

    /**
     * @testdox Caso optimo sin opcionales
     */
    public function test_subcategory_update_optimo_opcionales()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $update = [
            'category_id' => $subcategory['category_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'description' => '',
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}", $update);
        $response->assertStatus(200);

        $this->assertDatabaseHas('sub_categories', [
            'description' => ''
        ]);
    }

    /**
     * @testdox Caso optimo con descripcion vacia
     */
    public function test_subcategory_update_description_empty()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $update = [
            'category_id' => $subcategory['category_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'description' => '',
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox nombre de la subcategoria similar
     */
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

    /**
     * @testdox no existe la categoria 
     */
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

    /**
     * @testdox Subcategoria con estatus deshabilitado
     */
    public function test_subcategory_estatus_deshabilitado()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $update = [
            'category_id' => $subcategory['category_id'],
            'name' => 'SUBCATEGORIAAA',
            'description' => $faker->text($maxNbChars = 50),
            'status' => 0
        ];

        $response = $this->json('PUT', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}", $update);
        $response->assertStatus(200);
    }
}
