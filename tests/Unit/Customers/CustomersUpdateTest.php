<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Clientes (Indice)
|
| Descripcion: Este módulo muestra la información de los clientes con los que cuenta la tienda
|--------------------------------------------------------------------------
|
| 1) test_cliente_update_optimo()
|
| 2) test_cliente_update_sin_opcionales()
|
| 3) test_cliente_update_max_limit_inferior()
|
| 4) test_cliente_update_max_limit_superior()
|
| 5) test_cliente_update_min_limit_inferior()
|
| 6) test_cliente_update_email_fail()
|
| 7) test_cliente_email_same_update()
|
| 8) test_cliente_cambio_rol()
|
| 9) test_cliente_update_estatus_deshabilitado()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @testdox Como usuario con rol de administrador quiero actualizar la información del usuario para corregir sus datos incorrectos
 */
class CustomersUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para acturalizar un cliente
     */
    public function test_cliente_update_optimo()
    {
        $faker = \Faker\Factory::create();
        $name = $faker->name;

        $update = [
           'type' => 'cliente',
           'name' => $name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => '',
           'password_confirmation' => '',
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $response = $this->json('PUT', $this->baseUrl . "clientes/{$user->id}", $update);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => strtolower($name)
        ]);
    }

    /**
     * @testdox El apellido materno es opcional
     */
    public function test_cliente_update_sin_opcionales()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'type' => 'cliente',
           'name' => $faker->name,
           'father_surname' => $faker->lastName,
           'mother_surname' => '',
           'email' => $faker->unique()->safeEmail,
           'password' => '',
           'password_confirmation' => '',
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $response = $this->json('PUT', $this->baseUrl . "clientes/{$user->id}", $update);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'mother_surname' => ''
        ]);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_cliente_update_max_limit_inferior()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'type' => 'cliente',
           'name' => 'Consecteturhjsfacereprovidenterrorprovidentdeser',
           'mother_surname' => 'Consecteturhjsfacereprovidenterrorprov',
           'father_surname' => 'Consecteturhjsfacereprovidenterrorprov',
           'email' => $faker->unique()->safeEmail,
           'password' => '',
           'password_confirmation' => '',
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $response = $this->json('PUT', $this->baseUrl . "clientes/{$user->id}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_cliente_update_max_limit_superior()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'type' => 'cliente',
           'name' => 'Consecteturhjsfacereprovidenterrorprovidentdeserun',
           'mother_surname' => 'Consecteturhjsfacereprovidenterrorprsfd',
           'father_surname' => 'Consecteturhjsfacereprovidenterrorprsfd',
           'email' => $faker->unique()->safeEmail,
           'password' => '',
           'password_confirmation' => '',
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $response = $this->json('PUT', $this->baseUrl . "clientes/{$user->id}", $update);
        $response->assertStatus(422);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_cliente_update_min_limit_inferior()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'type' => 'cliente',
           'name' => 'df',
           'mother_surname' => 'gdg',
           'father_surname' => 'dfg',
           'email' => $faker->unique()->safeEmail,
           'password' => '',
           'password_confirmation' => '',
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $response = $this->json('PUT', $this->baseUrl . "clientes/{$user->id}", $update);
        $response->assertStatus(422);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_cliente_update_email_fail()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'type' => 'cliente',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => 'correonovalido.com',
           'password' => '',
           'password_confirmation' => '',
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $response = $this->json('PUT', $this->baseUrl . "clientes/{$user->id}", $update);
        $response->assertStatus(422);
    }

    /**
     * @testdox nombre del usuario es similar
     */
    public function test_cliente_email_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $update = [
           'type' => 'cliente',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $user->email,
           'password' => '',
           'password_confirmation' => '',
           'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "clientes/{$user->id}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox cambio a otro tipo de rol
     */
    public function test_cliente_cambio_rol()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $update = [
           'type' => 'administrador',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $user->email,
           'password' => '',
           'password_confirmation' => '',
           'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "clientes/{$user->id}", $update);
        $response->assertStatus(422);
    }

    /**
     * @testdox Cliente con estatus deshabilitado
     */
    public function test_cliente_update_estatus_deshabilitado()
    {
        $faker = \Faker\Factory::create();

        $update = [
           'type' => 'cliente',
           'name' => 'NOMBREE',
           'mother_surname' => $faker->lastName,
           'father_surname' => 'PATERNO',
           'email' => $faker->unique()->safeEmail,
           'password' => '@Cliente2907',
           'password_confirmation' => '@Cliente2907',
           'status' => 0
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $response = $this->json('PUT', $this->baseUrl . "clientes/{$user->id}", $update);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'status' => 0,
        ]);
    }
}
