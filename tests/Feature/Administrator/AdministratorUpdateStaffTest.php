<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Administradores (Indice)
|
| Descripcion: El módulo de administradores contiene los datos de los usuarios con el rol de STAFF y ADMINISTRADOR
|--------------------------------------------------------------------------
|
| 1) test_administrator_update_optimo()
|
| 2) test_administrator_update_sin_opcionales()
|
| 3) test_administrator_update_correo_similar()
|
| 4) test_administrator_update_estatus_deshabilitado()
|
| 5) test_administrator_update_password()
|
| 6) test_administrator_update_cambio_rol()
|
*/

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * 
 * @testdox Actualizar el usuario con rol de STAFF 
 * 
 */
class AdministratorUpdateStaffTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para actualizar un usuario con rol de STAFF
     */
    public function test_administrator_update_optimo()
    {
        $faker = \Faker\Factory::create();
        
        $update = [
           'type' => 'staff',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => 'prueba@correo.com',
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();
        
        $response = $this->json('PUT', $this->baseUrl . "administration/{$admin->id}", $update);
        $response->assertStatus(200);


    }

    /**
     * @testdox Caso optimo sin datos opcionales
     */
    public function test_administrator_update_sin_opcionales()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'type' => 'staff',
           'name' => $faker->name,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();

        $response = $this->json('PUT', $this->baseUrl . "administration/{$admin->id}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox update con el mismo correo del usuario con rol de staff
     */
    public function test_administrator_update_correo_similar()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();
        $faker = \Faker\Factory::create();

        $update = [
           'type' => 'staff',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $admin->email,
           'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "administration/{$admin->id}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox deshabilitando el estatus del usuario
     */
    public function test_administrator_update_estatus_deshabilitado()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();
        $faker = \Faker\Factory::create();

        $update = [
           'type' => 'staff',
           'name' => $faker->name,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 0
        ];

        $response = $this->json('PUT', $this->baseUrl . "administration/{$admin->id}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Cambio de contraseña del usuario con rol de staff
     */
    public function test_administrator_update_password()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'type' => 'staff',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => '@Prueba2907',
           'password_confirmation' => '@Prueba2907',
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();
        
        $response = $this->json('PUT', $this->baseUrl . "administration/{$admin->id}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Cambio de rol de staff a administrador
     */
    public function test_administrator_update_cambio_rol()
    {
        $faker = \Faker\Factory::create();
        
        $update = [
           'type' => 'administrador',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_admin();
        
        $response = $this->json('PUT', $this->baseUrl . "administration/{$admin->id}", $update);
        $response->assertStatus(422);
    }
}
