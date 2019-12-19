<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Admin;

class AdminsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_admin_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/admins', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('admins', $data);

        $admin = Admin::all()->first();

        $response->assertJson([
            'data' => [
                'admins' => [
                    'name' => $admin->name,
                    'mother_surname' => $admin->mother_surname,
                    'father_surname' => $admin->father_surname
                ],
                'password' => '@Admins2907'
            ]
        ]);
    }

    public function test_admin_empty_create()
    {
        $data = [];

        $response = $this->json('POST', '/api/v1/admins', $data);
        $response->assertStatus(422);
    }

    public function test_admin_max_field_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'name' => $faker->text($maxNbChars = 200),
           'father_surname' => $faker->text($maxNbChars = 200),
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/admins', $data);
        $response->assertStatus(422);
    }

    public function test_admin_min_field_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'name' => 'sd',
           'father_surname' => 'sd',
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/admins', $data);
        $response->assertStatus(422);
    }

    public function test_admin_email_faild_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'name' => $faker->name,
           'father_surname' => $faker->lastName,
           'email' => $faker->safeEmailDomain,
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/admins', $data);
        $response->assertStatus(422);
    }

    public function test_admin_update()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_admin();

        $response = $this->json('PUT', "/api/v1/admins/{$admin->id}", $update);
        $response->assertStatus(200);

        $admin = $admin->fresh();

        $this->assertEquals($admin->name, $update['name']);
        $this->assertEquals($admin->email, $update['email']);
    }

    public function test_admin_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_admin();
        $this->json('DELETE', "/api/v1/admins/{$admin->id}")->assertStatus(204);
        $this->assertNull(Admin::find($admin->id));
    }
}
