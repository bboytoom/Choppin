<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Admin;

/**
 * @testdox Accion actualizar en el modulo de administracion
 */
class AdminsUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_admin_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_admin();
        
        $update = [
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "admins/{$admin->id}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Correo similar al actualizar
     */
    public function test_admin_email_same_update()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_admin();

        $update = [
           'name' => $admin->name,
           'mother_surname' => $admin->mother_surname,
           'father_surname' => $admin->father_surname,
           'email' => $admin->email,
           'status' => 0
        ];

        $response = $this->json('PUT', $this->baseUrl . "admins/{$admin->id}", $update);
        $response->assertStatus(200);
    }
}
