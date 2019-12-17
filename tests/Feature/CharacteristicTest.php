<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Characteristic;

class CharacteristicTest extends TestCase
{
    use RefreshDatabase;

    public function test_characteristic_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
           'admin_id' => $product['admin_id'],
           'product_id' => $product['product_id'],
           'name' => 'Caracteristica uno',
           'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/characteristic', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('characteristics', $data);

        $characteristics = Characteristic::all()->first();

        $response->assertJson([
            'data' => [
                'characteristics' => [
                    'name' => $characteristics->name
                ]
            ]
        ]);
    }

    public function test_characteristic_min_field_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
           'admin_id' => $product['admin_id'],
           'product_id' => $product['product_id'],
           'name' => 's',
           'description' => 's',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/characteristic', $data);
        $response->assertStatus(422);
    }

    public function test_characteristic_max_field_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $data = [
           'admin_id' => $product['admin_id'],
           'product_id' => $product['product_id'],
           'name' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed mollis vel leo a vehicula. Quisque porta nunc nunc, in dapibus ipsum rutrum ac. Maecenas tincidunt arcu at lectus gravida, eu dapibus ipsum gravida. Sed ac efficitur nibh. Fusce vestibulum, justo pulvinar iaculis semper, nisi nunc tincidunt nisi, quis venenatis leo lacus at massa',
           'description' => 'sgddsddf',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/characteristic', $data);
        $response->assertStatus(422);
    }

    public function test_characteristic_update()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();
        
        $update = [
            'name' => 'Caracteristica dos',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
            'status' => 1
        ];

        $response = $this->json('PUT', "/api/v1/characteristic/{$characteristic['characteristic_id']}", $update);
        $response->assertStatus(200);

        $caract = Characteristic::all()->first();

        $this->assertEquals($caract->name, $update['name']);
    }

    public function test_characteristic_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $this->json('DELETE', "/api/v1/characteristic/{$characteristic['characteristic_id']}")->assertStatus(204);
        $this->assertNull(Characteristic::find($characteristic['characteristic_id']));
    }
}
