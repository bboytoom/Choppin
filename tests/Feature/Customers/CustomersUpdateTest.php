<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Clientes (Indice)
|
| Descripcion: Este módulo muestra la información de los clientes con los que cuenta la tienda
|--------------------------------------------------------------------------
|
| 1) test_cliente_update_optimo()
|
| 2) test_cliente_email_same_update()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * @testdox Accion actualizar en el modulo de usuario
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

        $update = [
           'type' => 'cliente',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'status' => 1
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $response = $this->json('PUT', $this->baseUrl . "clientes/{$user->id}", $update);
        $response->assertStatus(200);
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
           'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "clientes/{$user->id}", $update);
        $response->assertStatus(200);
    }
}
