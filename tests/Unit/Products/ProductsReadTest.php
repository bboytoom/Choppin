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
| 1) test_product_read_index()
|
| 2) test_product_read_show()
|
| 3) test_product_read_no_exist()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\Product;

/**
 * @testdox Como usuario con rol de administrador quiero listar los productos
 */
class ProductsReadTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Muestra todos los productos
     */
    public function test_product_read_index()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $response = $this->json('GET', $this->baseUrl . "products");
        $response->assertStatus(200);
    }

    /**
     * @testdox Muestra los detalles del producto
     */
    public function test_product_read_show()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $response = $this->json('GET', $this->baseUrl . "products/{$product['product_id']}");
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'type',
            'id',
            'attributes' => [
                'name',
                'slug',
                'extract',
                'description',
                'price',
                'status'
            ]
        ]);
    }

    /**
     * @testdox No existe el producto
     */
    public function test_product_read_no_exist()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $response = $this->json('GET', $this->baseUrl . "products/123");
        $response->assertStatus(404);
    }
}
