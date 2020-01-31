<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Admin;

class AdminsCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

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

        $response = $this->json('POST', $this->baseUrl . 'admins', $data);
        $response->assertStatus(201);
    }

    public function test_admin_same_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_admin();

        $data = [
           'name' => $admin->name,
           'mother_surname' => $admin->mother_surname,
           'father_surname' => $admin->father_surname,
           'email' => $admin->email,
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'admins', $data);
        $response->assertStatus(422);
    }

    public function test_admin_empty_create()
    {
        $data = [];

        $response = $this->json('POST', $this->baseUrl . 'admins', $data);
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

        $response = $this->json('POST', $this->baseUrl . 'admins', $data);
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

        $response = $this->json('POST', $this->baseUrl . 'admins', $data);
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

        $response = $this->json('POST', $this->baseUrl . 'admins', $data);
        $response->assertStatus(422);
    }
}
