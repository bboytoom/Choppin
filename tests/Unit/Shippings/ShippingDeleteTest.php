<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Shippings (Indice)
|
| Descripcion: Muestra la información de las direcciones de envío del cliente 
|--------------------------------------------------------------------------
|
| 1) test_shipping_delete()
|
| 2) test_shipping_delete_no_existe_dato()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shipping;

/**
 * @testdox Como usuario con rol de cliente quiero eliminar una dirección de envio por que ya no es necesaria
 */
class ShippingDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para eliminar una direccion
     */
    public function test_shipping_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $shipping = $seed->seed_shipping();

        $response = $this->json('DELETE', $this->baseUrl . "clientes/envio/{$shipping['shipping_id']}");
        $response->assertStatus(204);

        $shipp = Shipping::where('id', $shipping['shipping_id'])->count();
        $this->assertEquals(0, $shipp);
    }

    /**
     * @testdox No existe el usuario
     */
    public function test_shipping_delete_no_existe_dato()
    {
        $response = $this->json('DELETE', $this->baseUrl . "clientes/envio/122");
        $response->assertStatus(422);
    }
}
