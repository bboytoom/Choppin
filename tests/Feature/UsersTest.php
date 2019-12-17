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
        $data = [
           'name' => 'blisa',
           'mother_surname' => 'materno',
           'father_surname' => 'paterno',
           'email' => 'blisa@correo.com',
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
        $data = [
           'name' => 'blisanikichikitablisanikichikitablisanikichikitablisanikichikitablisanikichikitablisanikichikitablisanikichikita',
           'father_surname' => 'paternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaterno',
           'email' => 'blisa@correo.com',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/users', $data);
        $response->assertStatus(422);
    }

    public function test_user_email_faild_create()
    {
        $data = [
           'name' => 'niki',
           'father_surname' => 'paterno',
           'email' => 'ternisanikic',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/users', $data);
        $response->assertStatus(422);
    }

    public function test_user_update()
    {
        $update = [
           'name' => 'blisa',
           'mother_surname' => 'materno',
           'father_surname' => 'paterno',
           'email' => 'blisa@correo.com',
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
