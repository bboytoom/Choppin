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

        $user = User::all()->first();

        $response->assertJson([
            'data' => [
                'user' => [
                    'name' => $user->name,
                    'mother_surname' => $user->mother_surname,
                    'father_surname' => $user->father_surname
                ],
                'password' => '@Usuario2907'
            ]
        ]);
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

        $user = $user->fresh();

        $this->assertEquals($user->name, $update['name']);
        $this->assertEquals($user->email, $update['email']);
    }

    public function test_user_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_user();
        
        $this->json('DELETE', "/api/v1/users/{$user->id}")->assertStatus(204);
        $this->assertNull(User::find($user->id));
    }
}
