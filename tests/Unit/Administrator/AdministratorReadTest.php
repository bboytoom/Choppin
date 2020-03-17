<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Administradores (Indice)
|
| Descripcion: El módulo de administradores contiene los datos de los usuarios con el rol de STAFF y ADMINISTRADOR
|--------------------------------------------------------------------------
|
| 1) test_administrator_read_index()
|
| 2) test_administrator_read_show()
|
| 3) test_administrator_read_no_exist()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @testdox Como usuario con rol de administrador quiero mostrar los usuarios con rol de staff
 */
class AdministratorReadTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Muestra todos los usuarios
     */
    public function test_administrator_read_index()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();
        
        $response = $this->json('GET', $this->baseUrl . 'administration');
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                [
                    'type',
                    'id',
                    'attributes' => [
                        'name',
                        'mother_surname',
                        'father_surname',
                        'email',
                        'status'
                    ]
                ]
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next'
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'path',
                'per_page',
                'to',
                'total'
            ]
        ]);
    }

    /**
     * @testdox Muestra el detalle de un usuario con rol de staff
     */
    public function test_administrator_read_show()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();

        $response = $this->json('GET', $this->baseUrl . "administration/{$admin->id}");
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
     * @testdox No existe el usuario seleccionado
     */
    public function test_administrator_read_no_exist()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();

        $response = $this->json('GET', $this->baseUrl . "administration/12");
        $response->assertStatus(404);
    }
}
