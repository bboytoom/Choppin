<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Perfil del usuario con rol de staff (Indice)
|
| Descripcion: El módulo de perfil permite visualizar y gestionar la información de los usuarios con rol de STAFF,
|--------------------------------------------------------------------------
|
| 1) test_perfil_read_show()
|
| 2) test_perfil_read_no_exist()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * @testdox Como usuario con rol de staff quiero Visualizar mi perfil
 */
class PerfilReadTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Mostrar los detalles del perfil
     */
    public function test_perfil_read_show()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();

        $response = $this->json('GET', $this->baseUrl . "perfil/{$admin->id}");
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
     * @testdox Perfil no encontrado
     */
    public function test_perfil_read_no_exist()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();

        $response = $this->json('GET', $this->baseUrl . "perfil/123");
        $response->assertStatus(404);
    }
}
