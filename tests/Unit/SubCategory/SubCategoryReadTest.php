<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Categorías (Indice)
|
| Descripcion: Muestra la clasificación principal de los artículos que se venden
|--------------------------------------------------------------------------
|
| 1) test_subcategory_read_index()
|
| 2) test_subcategory_read_show()
|
| 3) test_subcategory_read_no_exist()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @testdox Como usuario con rol de administrador listar las subcategorias
 */
class SubCategoryReadTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Muestra todas las subcategorias
     */
    public function test_subcategory_read_index()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $response = $this->json('GET', $this->baseUrl . "subcategories");
        $response->assertStatus(200);
    }

    /**
     * @testdox Muestra los detalles de la subcategoria
     */
    public function test_subcategory_read_show()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $response = $this->json('GET', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}");
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'type',
            'id',
            'attributes' => [
                'name',
                'slug',
                'description',
                'status'
            ],
            'category' => [
                'type',
                'id',
                'name'
            ]
        ]);
    }

    /**
     * @testdox La subcategoria no existe
     */
    public function test_subcategory_read_no_exist()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $response = $this->json('GET', $this->baseUrl . "subcategories/123");
        $response->assertStatus(404);
    }
}
