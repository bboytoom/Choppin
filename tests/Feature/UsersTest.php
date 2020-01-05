<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/users', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('users', $data);
    }

    public function test_user_same_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_user();

        $data = [
           'name' => $user->name,
           'father_surname' => $user->father_surname,
           'email' => $user->email,
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/users', $data);
        $response->assertStatus(422);
    }

    public function test_user_empty_create()
    {
        $data = [];

        $response = $this->json('POST', '/api/v1/users', $data);
        $response->assertStatus(422);
    }

    public function test_user_max_field_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'name' => $faker->text($maxNbChars = 200),
           'father_surname' => $faker->text($maxNbChars = 200),
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/users', $data);
        $response->assertStatus(422);
    }

    public function test_user_min_field_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'name' => 'sd',
           'father_surname' => 'sd',
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/users', $data);
        $response->assertStatus(422);
    }

    public function test_user_email_faild_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'name' => $faker->name,
           'father_surname' => $faker->lastName,
           'email' => $faker->safeEmailDomain,
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/users', $data);
        $response->assertStatus(422);
    }

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

        $response = $this->json('PUT', "/api/v1/users/{$user->id}", $update);
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

        $response = $this->json('PUT', "/api/v1/users/{$user->id}", $update);
        $response->assertStatus(200);
    }

    public function test_user_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_user();
        
        $this->json('DELETE', "/api/v1/users/{$user->id}")->assertStatus(204);
        $this->assertNull(User::find($user->id));
    }
}
