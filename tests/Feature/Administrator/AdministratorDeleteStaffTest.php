<?php

namespace Tests\Feature\Administrator;

/*
|--------------------------------------------------------------------------
| Administradores (Indice)
|
| Descripcion: El módulo de administradores contiene los datos de los usuarios con el rol de STAFF y ADMINISTRADOR
|--------------------------------------------------------------------------
|
| 1) test_administrator_delete()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * 
 * @testdox Eliminar el usuario con rol de STAFF 
 * 
 */
class AdministratorDeleteStaffTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_administrator_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();
        
        $this->json('DELETE', $this->baseUrl . "administration/{$admin->id}")->assertStatus(204);
    }
}
