<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Shipping;

class ShippingTest extends TestCase
{
    use RefreshDatabase;

    public function test_shipping_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_user();

        $data = [
            'user_id' => $user->id,
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

        $response = $this->json('POST', '/api/v1/shippings', $data);
        $response->assertStatus(201);
    }

    public function test_shipping_max_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_user();

        $data = [
            'user_id' => $user->id,
            'street_one' => $faker->text($maxNbChars = 300),
            'street_two' => $faker->text($maxNbChars = 300),
            'addres' => $faker->text($maxNbChars = 300),
            'suburb' => $faker->text($maxNbChars = 300),
            'town' => $faker->text($maxNbChars = 300),
            'state' => $faker->text($maxNbChars = 300),
            'country' => 'mexico',
            'postal_code' => $faker->numerify('0 ####'),
            'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/shippings', $data);
        $response->assertStatus(422);
    }

    public function test_shipping_min_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_user();

        $data = [
            'user_id' => $user->id,
            'street_one' => 'qw',
            'street_two' => 'qw',
            'addres' => 'qw',
            'suburb' => 'qw',
            'town' => 'qw',
            'state' => 'qw',
            'country' => 'mexico',
            'postal_code' => $faker->numerify('0 ####'),
            'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/shippings', $data);
        $response->assertStatus(422);
    }

    public function test_shipping_user_no_exist_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'user_id' => 0,
            'street_one' => $faker->text($maxNbChars = 300),
            'street_two' => $faker->text($maxNbChars = 300),
            'addres' => $faker->text($maxNbChars = 300),
            'suburb' => $faker->text($maxNbChars = 300),
            'town' => $faker->text($maxNbChars = 300),
            'state' => $faker->text($maxNbChars = 300),
            'country' => 'mexico',
            'postal_code' => $faker->numerify('0 ####'),
            'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/shippings', $data);
        $response->assertStatus(422);
    }

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

        $response = $this->json('PUT', "/api/v1/shippings/{$shipping['shipping_id']}", $update);
        $response->assertStatus(200);
    }

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

        $response = $this->json('PUT', "/api/v1/shippings/{$shipping['shipping_id']}", $update);
        $response->assertStatus(422);
    }

    public function test_shipping_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $shipping = $seed->seed_shipping();

        $this->json('DELETE', "/api/v1/shippings/{$shipping['shipping_id']}")->assertStatus(204);
        $this->assertNull(Shipping::find($shipping['shipping_id']));
    }
}
