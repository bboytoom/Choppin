<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Administradores (Indice)
|
| Descripcion: El módulo de administradores contiene los datos de los usuarios con el rol de STAFF y ADMINISTRADOR
|--------------------------------------------------------------------------
|
| 1) test_administrator_delete()
|
| 2) test_administrator_delete_no_id()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * 
 * @testdox Como usuario con rol de administrador quiero eliminar a un usuario con rol de staff por què ya no es requerido.
 * 
 */
class AdministratorDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para eliminar un usuario con rol de staff
     */
    public function test_administrator_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();
        
        $this->json('DELETE', $this->baseUrl . "administration/{$admin->id}")->assertStatus(204);
    }

    /**
     * @testdox Eliminar usuario que no existe
     */
    public function test_administrator_delete_no_id()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();
        
        $this->json('DELETE', $this->baseUrl . "administration/10")->assertStatus(404);
    }
}
