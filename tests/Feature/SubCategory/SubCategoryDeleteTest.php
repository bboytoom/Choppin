<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Categorías (Indice)
|
| Descripcion: Muestra la clasificación principal de los artículos que se venden
|--------------------------------------------------------------------------
|
| 1) test_subcategory_delete()
|
| 2) test_subcategory_delete_no_id()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SubCategory;

/**
 * @testdox Como usuario con rol de administrador quiero eliminar la subcategoría por que ya no es necesaria.
 */
class SubCategoryDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo
     */
    public function test_subcategory_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $this->json('DELETE', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}")->assertStatus(204);
    }

    /**
     * @testdox La subcategoria no existe
     */
    public function test_subcategory_delete_no_id()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $this->json('DELETE', $this->baseUrl . "subcategories/545")->assertStatus(422);
    }
}
