<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Administradores (Indice)
|
| Descripcion: El módulo de administradores contiene los datos de los usuarios con el rol de STAFF y ADMINISTRADOR
|--------------------------------------------------------------------------
|
| 1) test_administrator_update_optimo_staff()
|
| 2) test_administrator_update_optimo_administrador()
|
| 3) test_administrator_update_correo_similar()
|
| 4) test_administrator_update_estatus_deshabilitado()
|
| 5) test_administrator_update_password()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * 
 * @testdox Como usuario con privilegios quiero actualizar mi información de usuario por què tuve un error algunos datos.
 * 
 */
class AdministratorUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para actualizar un usuario con rol de staff
     */
    public function test_administrator_update_optimo_staff()
    {
        $faker = \Faker\Factory::create();
        
        $update = [
           'type' => 'staff',
           'name' => 'prueba',
           'mother_surname' => $faker->lastName,
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
     * @testdox Caso optimo para actualizar un usuario con rol de administrador
     */
    public function test_administrator_update_optimo_administrador()
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
        $admin = $seed->seed_administrator_staff();
        
        $response = $this->json('PUT', $this->baseUrl . "administration/{$admin->id}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Solo se actualiza el nombre del usuario con rol de staff
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
     * @testdox El usuario con rol de administrador no puede tener el estatus de deshabilitado
     */
    public function test_administrator_update_estatus_deshabilitado()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_admin();
        $faker = \Faker\Factory::create();

        $update = [
           'type' => 'administrador',
           'name' => $faker->name,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 0
        ];

        $response = $this->json('PUT', $this->baseUrl . "administration/{$admin->id}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Cambio de contraseña
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
}
