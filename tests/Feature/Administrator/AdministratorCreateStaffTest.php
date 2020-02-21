<?php

namespace Tests\Feature\Administrator;

/*
|--------------------------------------------------------------------------
| Administradores (Indice)
|
| Descripcion: El módulo de administradores contiene los datos de los usuarios con el rol de STAFF y ADMINISTRADOR
|--------------------------------------------------------------------------
|
| 1) test_administrator_create_optimo()
| 
| 2) test_administrator_create_sin_opcionales()
| 
| 3) test_administrador_create_max_limit_inferior()
| 
| 4) test_administrador_create_max_limit_superior()
|
| 5) test_administrador_create_min_limit_inferior()
|
| 6) test_administrador_create_min_limit_superior()
|
| 7) test_administrador_create_email()
|
| 8) test_administrador_email_same_create()
|
| 9) test_administrator_create_vacio()
|
| 10) test_administrator_create_vacio_requerido()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * 
 * @testdox Crear el usuario con rol de STAFF 
 * 
 */
class AdministratorCreateStaffTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para crear un usuario con rol de STAFF
     */
    public function test_administrator_create_optimo()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        dd($response);
    }

    /**
     * @testdox Caso optimo sin datos opcionales
     */
    public function test_administrator_create_sin_opcionales()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->name,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_administrador_create_max_limit_inferior()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->text($maxNbChars = 48),
           'mother_surname' => $faker->text($maxNbChars = 38),
           'father_surname' => $faker->text($maxNbChars = 38),
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite superior 
     */
    public function test_administrador_create_max_limit_superior()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->text($maxNbChars = 50),
           'mother_surname' => $faker->text($maxNbChars = 40),
           'father_surname' => $faker->text($maxNbChars = 40),
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite inferior 
     */
    public function test_administrador_create_min_limit_inferior()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->text($maxNbChars = 2),
           'mother_surname' => $faker->text($maxNbChars = 3),
           'father_surname' => $faker->text($maxNbChars = 3),
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite superior 
     */
    public function test_administrador_create_min_limit_superior()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->text($maxNbChars = 4),
           'mother_surname' => $faker->text($maxNbChars = 5),
           'father_surname' => $faker->text($maxNbChars = 5),
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Correo no valido para el usuario con rol de staff
     */
    public function test_administrador_create_email()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->text($maxNbChars = 4),
           'mother_surname' => $faker->text($maxNbChars = 5),
           'father_surname' => $faker->text($maxNbChars = 5),
           'email' => 'correonovalido.com',
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Correo que ya existe para el usuario con rol de staff
     */
    public function test_administrador_email_same_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user_staff = $seed->seed_administrator_staff();
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $admin->email,
           'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox No se ingreso ningun tipo de dato
     */
    public function test_administrator_create_vacio()
    {
        $data = [];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox No se ingreso un campo requerido
     */
    public function test_administrator_create_vacio_requerido()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'mother_surname' => $faker->lastName
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }
}
