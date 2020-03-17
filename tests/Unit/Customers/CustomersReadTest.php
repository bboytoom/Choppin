<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Clientes (Indice)
|
| Descripcion: Este módulo muestra la información de los clientes con los que cuenta la tienda
|--------------------------------------------------------------------------
|
| 1) test_cliente_read_index()
|
| 2) test_cliente_read_show()
|
| 3) test_cliente_read_no_exist()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @testdox Como usuario con rol de administrador quiero listar todos mis clientes
 */
class CustomersReadTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Muestra todos los clientes
     */
    public function test_cliente_read_index()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $response = $this->json('GET', $this->baseUrl . "clientes");
        $response->assertStatus(200);
    }

    /**
     * @testdox Muestra todos los clientes
     */
    public function test_cliente_read_show()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $response = $this->json('GET', $this->baseUrl . "clientes/{$user->id}");
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'type',
            'id',
            'attributes' => [
                'name',
                'mother_surname',
                'father_surname',
                'email',
                'status'
            ]
        ]);
    }

    /**
     * @testdox Muestra todos los clientes
     */
    public function test_cliente_read_no_exist()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();

        $response = $this->json('GET', $this->baseUrl . "clientes/123");
        $response->assertStatus(404);
    }
}
