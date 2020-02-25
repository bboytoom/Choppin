<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Clientes (Indice)
|
| Descripcion: Este módulo muestra la información de los clientes con los que cuenta la tienda
|--------------------------------------------------------------------------
|
| 1) test_cliente_delete_optimo()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * @testdox Accion eliminar en el modulo de usuario
 */
class CustomersDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para eliminar un cliente
     */
    public function test_cliente_delete_optimo()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();
        
        $this->json('DELETE', $this->baseUrl . "clientes/{$user->id}")->assertStatus(204);
    }
}
