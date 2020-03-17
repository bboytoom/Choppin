<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Categorías (Indice)
|
| Descripcion: Muestra la clasificación principal de los artículos que se venden
|--------------------------------------------------------------------------
|
| 1) test_category_read_index()
|
| 2) test_category_read_show()
|
| 3) test_category_read_no_exist()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @testdox  Como usuario con rol de administrador quiero mostrar todas las categorias
 */
class CategoryReadTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Muestra todas las categorias
     */
    public function test_category_read_index()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $response = $this->json('GET', $this->baseUrl . "categories");
        $response->assertStatus(200);
    }

    /**
     * @testdox Muestra los detalles de la categoria
     */
    public function test_category_read_show()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();
        
        $response = $this->json('GET', $this->baseUrl . "categories/{$category['category_id']}");
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'type',
            'id',
            'attributes' => [
                'name',
                'slug',
                'description',
                'status'
            ]
        ]);
    }

    /**
     * @testdox No existe la categoria
     */
    public function test_category_read_no_exist()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();
        
        $response = $this->json('GET', $this->baseUrl . "categories/123");
        $response->assertStatus(404);
    }
}
