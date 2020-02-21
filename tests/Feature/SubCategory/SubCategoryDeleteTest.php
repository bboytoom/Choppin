<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\SubCategory;

/**
 * @testdox Accion eliminar en el modulo de subcategoria
 */
class SubCategoryDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_subcategory_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $subcategory = $seed->seed_subcategory();

        $this->json('DELETE', $this->baseUrl . "subcategories/{$subcategory['subcategoria_id']}")->assertStatus(204);
    }
}