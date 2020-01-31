<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Configuration;

class ConfigurationCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_configuration_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'domain' => $faker->domainName,
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => $faker->text($maxNbChars = 100),
            'email' => $faker->email,
            'phone' => $faker->tollFreePhoneNumber,
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'configurations', $data);
        $response->assertStatus(201);
    }

    public function test_configuration_same_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $data = [
            'domain' => $configuration['domain'],
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => $faker->text($maxNbChars = 100),
            'email' => $faker->email,
            'phone' => $faker->tollFreePhoneNumber,
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'configurations', $data);
        $response->assertStatus(422);
    }

    public function test_configuration_max_field_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'domain' => $faker->text($maxNbChars = 360),
            'name' => $faker->text($maxNbChars = 390),
            'business_name' => $faker->text($maxNbChars = 360),
            'slogan' => $faker->text($maxNbChars = 100),
            'email' => $faker->email,
            'phone' => $faker->tollFreePhoneNumber,
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'configurations', $data);
        $response->assertStatus(422);
    }

    public function test_configuration_min_field_create()
    {
        $data = [
            'domain' => 'as',
            'name' => 'as',
            'business_name' => 'as',
            'slogan' => 'as',
            'email' => 'as',
            'phone' => 'as',
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'configurations', $data);
        $response->assertStatus(422);
    }

    public function test_configuration_empy_create()
    {
        $data = [];

        $response = $this->json('POST', $this->baseUrl . 'configurations', $data);
        $response->assertStatus(422);
    }
}
