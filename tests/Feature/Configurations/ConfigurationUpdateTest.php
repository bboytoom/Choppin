<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Configuration;

class ConfigurationUpdateTest extends TestCase
{ 
    use RefreshDatabase, WithoutMiddleware;

    public function test_configuration_update()
    {
        $faker = \Faker\Factory::create();

        $update = [
            'domain' => $faker->domainName,
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => $faker->text($maxNbChars = 100),
            'email' => $faker->email,
            'phone' => $faker->tollFreePhoneNumber,
            'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $response = $this->json('PUT', $this->baseUrl . "configurations/{$configuration['configuration_id']}", $update);
        $response->assertStatus(200);
    }

    public function test_configuration_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();

        $configuration = $seed->seed_configuration();

        $update = [
            'domain' => $configuration['domain'],
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => $faker->text($maxNbChars = 100),
            'email' => $faker->email,
            'phone' => $faker->tollFreePhoneNumber,
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/{$configuration['configuration_id']}", $update);
        $response->assertStatus(200);
    }
}