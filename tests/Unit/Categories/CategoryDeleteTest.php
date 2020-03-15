<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Categorías (Indice)
|
| Descripcion: Muestra la clasificación principal de los artículos que se venden
|--------------------------------------------------------------------------
|
| 1) test_category_delete()
|
| 2) test_category_delete_no_id()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

/**
 * @testdox Como usuario con rol de administrador quiero eliminar la categoría por que ya no es necesaria.
 */
class CategoryDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo
     */
    public function test_category_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $this->json('DELETE', $this->baseUrl . "categories/{$category['category_id']}")->assertStatus(204);
        
        $cat = Category::where('id', $category['category_id'])->count();
        $this->assertEquals(0, $cat);
    }

    /**
     * @testdox La categoria no existe
     */
    public function test_category_delete_no_id()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $this->json('DELETE', $this->baseUrl . "categories/100")->assertStatus(422);
    }
}
