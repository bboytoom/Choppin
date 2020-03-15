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
| 1) test_characteristic_delete()
|
| 2) test_characteristic_delete_no_id()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Characteristic;

/**
 * @testdox Como usuario con rol de administrador quiero eliminar una característica por què ya no es requerida.
 */
class CharacteristicDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo
     */
    public function test_characteristic_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $this->json('DELETE', $this->baseUrl . "products/characteristics/{$characteristic['characteristic_id']}")->assertStatus(204);
        
        $charac = Characteristic::where('id', $characteristic['characteristic_id'])->count();
        $this->assertEquals(0, $charac);
    }

    /**
     * @testdox La caracteristica no existe
     */
    public function test_characteristic_delete_no_id()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $this->json('DELETE', $this->baseUrl . "products/characteristics/343")->assertStatus(422);
    }
}
