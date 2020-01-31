<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Configuration;

class ConfigurationDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_configuration_same_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $this->json('DELETE', $this->baseUrl . "configurations/{$configuration['configuration_id']}")->assertStatus(204);
    }
}
