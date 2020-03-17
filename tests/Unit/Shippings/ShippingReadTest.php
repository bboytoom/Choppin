<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Shippings (Indice)
|
| Descripcion: Muestra la información de las direcciones de envío del cliente 
|--------------------------------------------------------------------------
|
| 1) 
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shipping;

/**
 * @testdox Como usuario con rol de cliente quiero listar mis direcciones de envio
 */
class ShippingReadTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Muestra todas las direcciones
     */
    public function test_shipping_read_index()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $shipping = $seed->seed_shipping();

        $response = $this->json('GET', $this->baseUrl . "clientes/envio/all/{$shipping['user_id']}");
        $response->assertStatus(200);
    }

    /**
     * @testdox Muestra los detalles de la direccion de envio
     */
    public function test_shipping_read_show()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $shipping = $seed->seed_shipping();

        $response = $this->json('GET', $this->baseUrl . "clientes/envio/{$shipping['shipping_id']}");
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'type',
            'id',
            'attributes' => [
                'street_one',
                'street_two',
                'addres',
                'suburb',
                'town',
                'status',
                'state',
                'country',
                'postal_code'
            ]
        ]);
    }

    /**
     * @testdox La direccion de envio no existe
     */
    public function test_shipping_read_no_exist()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $shipping = $seed->seed_shipping();

        $response = $this->json('GET', $this->baseUrl . "clientes/envio/123}");
        $response->assertStatus(404);
    }
}
