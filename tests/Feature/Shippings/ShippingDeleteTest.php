<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shipping;

/**
 * @testdox Accion eliminar en el modulo de envios
 */
class ShippingDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_shipping_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $shipping = $seed->seed_shipping();

        $this->json('DELETE', $this->baseUrl . "shippings/{$shipping['shipping_id']}")->assertStatus(204);
    }
}
