<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Clientes (Indice)
|
| Descripcion: Este módulo muestra la información de los clientes con los que cuenta la tienda
|--------------------------------------------------------------------------
|
| 1) test_cliente_delete_optimo()
|
| 2) test_cliente_delete_no_id()
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
        
        $users = User::where('id', $user->id)->count();
        $this->assertEquals(0, $users);
    }

    /**
     * @testdox El cliente no existe
     */
    public function test_cliente_delete_no_id()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_administrator_cliente();
        
        $this->json('DELETE', $this->baseUrl . "clientes/234")->assertStatus(422);
    }
}
