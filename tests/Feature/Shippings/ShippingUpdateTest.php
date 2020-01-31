<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shipping;

/**
 * @testdox Accion actualizar en el modulo de envios
 */
class ShippingUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_shipping_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $shipping = $seed->seed_shipping();

        $update = [
            'user_id' => $shipping['user_id'],
            'street_one' => $faker->streetAddress,
            'street_two' => $faker->streetAddress,
            'addres' => $faker->address,
            'suburb' => $faker->citySuffix,
            'town' => $faker->city,
            'state' => $faker->state,
            'country' => 'mexico',
            'postal_code' => $faker->numerify('0 ####'),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "shippings/{$shipping['shipping_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox no existe el usuarios
     */
    public function test_shipping_user_no_exist_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $shipping = $seed->seed_shipping();

        $update = [
            'user_id' => 0,
            'street_one' => $faker->streetAddress,
            'street_two' => $faker->streetAddress,
            'addres' => $faker->address,
            'suburb' => $faker->citySuffix,
            'town' => $faker->city,
            'state' => $faker->state,
            'country' => 'mexico',
            'postal_code' => $faker->numerify('0 ####'),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "shippings/{$shipping['shipping_id']}", $update);
        $response->assertStatus(422);
    }
}
