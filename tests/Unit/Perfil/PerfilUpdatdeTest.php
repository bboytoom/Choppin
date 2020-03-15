<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Perfil del usuario con rol de staff (Indice)
|
| Descripcion: El módulo de perfil permite visualizar y gestionar la información de los usuarios con rol de STAFF,
|--------------------------------------------------------------------------
|
| 1) test_perfil_update_optimo()
|
| 2) test_perfil_update_deshabilitado()
|
| 3) test_perfil_update_cambio_rol()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * @testdox Como usuario con rol de staff quiero actualizar mi información
 */
class PerfilUpdatdeTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para actualizar un usuario con rol de staff
     */
    public function test_perfil_update_optimo()
    {
        $faker = \Faker\Factory::create();
        $name = $faker->name;
        
        $update = [
           'type' => 'staff',
           'name' => $name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => '',
           'password_confirmation' => '',
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();
        
        $response = $this->json('PUT', $this->baseUrl . "perfil/{$admin->id}", $update);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => strtolower($name)
        ]);
    }

    /**
     * @testdox El usuario con rol de staff no puede desactivar su cuenta
     */
    public function test_perfil_update_deshabilitado()
    {
        $faker = \Faker\Factory::create();
        
        $update = [
           'type' => 'staff',
           'name' => 'NOMBREEeEE',
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => '@Prueba123',
           'password_confirmation' => '@Prueba123',
           'status' => 0
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();
        
        $response = $this->json('PUT', $this->baseUrl . "perfil/{$admin->id}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox El usuario con rol de staff no puede cambiar de rol.
     */
    public function test_perfil_update_cambio_rol()
    {
        $faker = \Faker\Factory::create();
        
        $update = [
           'type' => 'administrador',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => '',
           'password_confirmation' => '',
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();
        
        $response = $this->json('PUT', $this->baseUrl . "perfil/{$admin->id}", $update);
        $response->assertStatus(422);
    }
}
