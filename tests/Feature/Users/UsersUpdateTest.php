<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UsersUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_user_update()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'name' => 'blisa',
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 0
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_user();

        $response = $this->json('PUT', $this->baseUrl . "users/{$user->id}", $update);
        $response->assertStatus(200);
    }

    public function test_user_email_same_update()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_user();

        $update = [
           'name' => $user->name,
           'mother_surname' => $user->mother_surname,
           'father_surname' => $user->father_surname,
           'email' => $user->email,
           'status' => 0
        ];

        $response = $this->json('PUT', $this->baseUrl . "users/{$user->id}", $update);
        $response->assertStatus(200);
    }
}
