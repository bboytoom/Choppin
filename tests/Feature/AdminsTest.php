<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Admin;

class AdminsTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_create()
    {
       $data = [
           'name' => 'blisa',
           'mother_surname' => 'materno',
           'father_surname' => 'paterno',
           'email' => 'blisa@correo.com',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/admin/admins', $data);
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

        $response = $this->json('POST', '/api/admin/admins', $data);
        $response->assertStatus(422);
    }

    public function test_admin_max_field_create()
    {
        $data = [
           'name' => 'blisanikichikitablisanikichikitablisanikichikitablisanikichikitablisanikichikitablisanikichikitablisanikichikita',
           'father_surname' => 'paternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaterno',
           'email' => 'blisa@correo.com',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/admin/admins', $data);
        $response->assertStatus(422);
    }

    public function test_admin_email_faild_create()
    {
        $data = [
           'name' => 'niki',
           'father_surname' => 'paterno',
           'email' => 'ternisanikic',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/admin/admins', $data);
        $response->assertStatus(422);
    }

    public function test_admin_update()
    {
        $update = [
           'name' => 'chikita',
           'mother_surname' => 'materno',
           'father_surname' => 'paterno',
           'email' => 'chikita@correo.com',
           'status' => 0
        ];

        $seed = new SeedTest();
        $admin = $seed->seed_admin();

        $response = $this->json('PUT', "/api/admin/admins/{$admin->id}", $update);
        $response->assertStatus(200);

        $admin = $admin->fresh();

        $this->assertEquals($admin->name, $update['name']);
        $this->assertEquals($admin->email, $update['email']);
    }

    public function test_admin_delete()
    {
        $seed = new SeedTest();
        $admin = $seed->seed_admin();
        $this->json('DELETE', "/api/admin/admins/{$admin->id}")->assertStatus(204);
        $this->assertNull(Admin::find($admin->id));
    }
}
