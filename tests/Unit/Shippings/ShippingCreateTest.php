<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Shippings (Indice)
|
| Descripcion: Muestra la información de las direcciones de envío del cliente 
|--------------------------------------------------------------------------
|
| 1) test_shipping_create_optima()
|
| 2) test_shipping_create_sin_opcionales()
|
| 3) test_shipping_create_max_limit_inferior()
|
| 4) test_shipping_create_max_limit_superior()
|
| 5) test_shipping_create_min_limit_inferior()
|
| 6) test_shipping_user_no_exist_create()
|
| 7) test_shipping_vacio()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @testdox Como usuario con rol de cliente quiero agregar una nueva dirección de envío para que mi producto llegue 
 */
class ShippingCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para crear una nueva direccion de envio
     */
    public function test_shipping_create_optima()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();
        $suburb = $faker->citySuffix;

        $data = [
            'user_id' => $user->id,
            'street_one' => $faker->streetAddress,
            'street_two' => $faker->streetAddress,
            'addres' => $faker->address,
            'suburb' => $suburb,
            'town' => $faker->city,
            'state' => $faker->state,
            'country' => 'mexico',
            'postal_code' => $faker->numerify('0 ####')
        ];

        $response = $this->json('POST', $this->baseUrl . 'clientes/envio', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('shippings', [
            'suburb' => $suburb
        ]);
    }

    /**
     * @testdox Caso sin datos opcionales
     */
    public function test_shipping_create_sin_opcionales()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $data = [
            'user_id' => $user->id,
            'street_one' => $faker->streetAddress,
            'street_two' => '',
            'addres' => $faker->address,
            'suburb' => $faker->citySuffix,
            'town' => $faker->city,
            'state' => $faker->state,
            'country' => 'mexico',
            'postal_code' => $faker->numerify('0 ####')
        ];

        $response = $this->json('POST', $this->baseUrl . 'clientes/envio', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('shippings', [
            'street_two' => ''
        ]);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_shipping_create_max_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $data = [
            'user_id' => $user->id,
            'street_one' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdesds',
            'street_two' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdesds',
            'addres' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjsho',
            'suburb' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjsho',
            'town' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjsho',
            'state' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhj',
            'country' => 'hssjshdjfhjdfhjdfhd',
            'postal_code' => $faker->numerify('0 ####')
        ];

        $response = $this->json('POST', $this->baseUrl . 'clientes/envio', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite superior 
     */
    public function test_shipping_create_max_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $data = [
            'user_id' => $user->id,
            'street_one' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdesdssd',
            'street_two' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdesdssd',
            'addres' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshodf',
            'suburb' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshodf',
            'town' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfhdwemdehssjshodf',
            'state' => 'hssjshdjfhjdfhjdfhdwemdehssjshdjfhjdfhjdfsd',
            'country' => 'hssjshdjfhjdfhjdfhdsd',
            'postal_code' => $faker->numerify('0 ####')
        ];

        $response = $this->json('POST', $this->baseUrl . 'clientes/envio', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_shipping_create_min_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $data = [
            'user_id' => $user->id,
            'street_one' => 'sdd',
            'street_two' => 'sdd',
            'addres' => 'sdd',
            'suburb' => 'sdd',
            'town' => 'sdd',
            'state' => 'sdd',
            'country' => 'sdd',
            'postal_code' => $faker->numerify('0 ####')
        ];

        $response = $this->json('POST', $this->baseUrl . 'clientes/envio', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox no existe el usuario 
     */
    public function test_shipping_user_no_exist_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'user_id' => 0,
            'street_one' => $faker->streetAddress,
            'addres' => $faker->address,
            'suburb' => $faker->citySuffix,
            'town' => $faker->city,
            'state' => $faker->state,
            'country' => 'mexico',
            'postal_code' => $faker->numerify('0 ####')
        ];

        $response = $this->json('POST', $this->baseUrl . 'clientes/envio', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox datos vacios
     */
    public function test_shipping_vacio()
    {
        $faker = \Faker\Factory::create();

        $data = [];

        $response = $this->json('POST', $this->baseUrl . 'clientes/envio', $data);
        $response->assertStatus(422);
    }
}
