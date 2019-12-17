<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shipping;

class ShippingTest extends TestCase
{
    use RefreshDatabase;

    public function test_chipping_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_user();

        $data = [
            'user_id' => $user->id,
            'street_one' => 'calle uno',
            'street_two' => 'calle dos',
            'addres' => 'mi casita :)',
            'suburb' => 'En un lugar de iztapalapa',
            'town' => 'iztapalapa',
            'state' => 'ciudad de mexico',
            'country' => 'mexico',
            'postal_code' => '08921',
            'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/shipping', $data);
        $response->assertStatus(201);
    }

    public function test_chipping_update()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $shipping = $seed->seed_shipping();

        $update = [
            'street_one' => 'calle tres',
            'street_two' => 'calle cuatro',
            'addres' => 'mi no casita :)',
            'suburb' => 'En un lugar cerca de neza',
            'town' => 'Ciudad neza',
            'state' => 'Estado de mexico',
            'country' => 'mexico',
            'postal_code' => '08934',
            'status' => 1
        ];

        $response = $this->json('PUT', "/api/v1/shipping/{$shipping['shipping_id']}", $update);
        $response->assertStatus(200);

        $ship = Shipping::all()->first();

        $this->assertEquals($ship->addres, $update['addres']);
    }

    public function test_chipping_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $shipping = $seed->seed_shipping();

        $this->json('DELETE', "/api/v1/shipping/{$shipping['shipping_id']}")->assertStatus(204);
        $this->assertNull(Shipping::find($shipping['shipping_id']));
    }
}
