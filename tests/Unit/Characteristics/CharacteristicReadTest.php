<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Características (Indice)
|
| Descripcion: Muestra los detalles de cada producto
| Precondición: Es necesario que el producto se haya creado con anterioridad
|--------------------------------------------------------------------------
|
| 1) test_characteristic_read_index()
|
| 2) test_characteristic_read_show()
|
| 3) test_characteristic_read_no_exist()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @testdox Como usuario con rol de administrador quiero listar las características de los productos
 */
class CharacteristicReadTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Muestra todas las caracteristicas
     */
    public function test_characteristic_read_index()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $response = $this->json('GET', $this->baseUrl . "products/characteristics/all/{$characteristic['product_id']}");
        $response->assertStatus(200);
    }

    /**
     * @testdox Muestra los detalles de una caracteristica
     */
    public function test_characteristic_read_show()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $response = $this->json('GET', $this->baseUrl . "products/characteristics/{$characteristic['characteristic_id']}");
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'type',
            'id',
            'attributes' => [
                'name',
                'description',
                'status'
            ],
            'product' => [
                'type',
                'id',
                'name'
            ]
        ]);
    }

    /**
     * @testdox No existe la caracteristica
     */
    public function test_characteristic_read_no_exist()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $response = $this->json('GET', $this->baseUrl . "products/characteristics/123");
        $response->assertStatus(404);
    }
}
