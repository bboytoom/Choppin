<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Productos (Indice)
|
| Descripción: Muestra la información de los productos que se venden
| Precondición: Es necesario que la categoría y la subcategoría se hayan creado con anterioridad
|--------------------------------------------------------------------------
|
| 1) test_product_delete()
|
| 2) test_product_delete_no_id()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\Product;

/**
 * @testdox Como usuario con rol de administrador quiero eliminar un producto por que ya no es necesario.
 */
class ProductTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_product_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $this->json('DELETE', $this->baseUrl . "products/{$product['product_id']}")->assertStatus(204);

        $cat = Product::where('id', $product['product_id'])->count();
        $this->assertEquals(0, $cat);
    }

    /**
     * @testdox El producto no existe
     */
    public function test_product_delete_no_id()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $this->json('DELETE', $this->baseUrl . "products/213")->assertStatus(422);
    }
}
