<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Characteristic;

class CharacteristicDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_characteristic_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $characteristic = $seed->seed_characteristic();

        $this->json('DELETE', $this->baseUrl . "characteristics/{$characteristic['characteristic_id']}")->assertStatus(204);
    }
}
