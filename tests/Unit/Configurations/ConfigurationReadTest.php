<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Configuración (Indice)
|
| Descripcion: Muestra la información de la tienda por ejemplo, el nombre de la tienda, el dominio , etc..
|--------------------------------------------------------------------------
|
| 1) test_configuration_read_index()
|
| 2) test_configuration_read_show()
|
| 3) test_configuration_read_no_exist()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @testdox Como usuario con rol de administrador quiero mostrar mi configuracion de la tienda
 */
class ConfigurationReadTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Muestra la configuracion
     */
    public function test_configuration_read_index()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $response = $this->json('GET', $this->baseUrl . "configurations");
        $response->assertStatus(200);
    }

    /**
     * @testdox Muestra los detalles de la configuracion
     */
    public function test_configuration_read_show()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $response = $this->json('GET', $this->baseUrl . "configurations/{$configuration['configuration_id']}");
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'type',
            'id',
            'attributes' => [
                'domain',
                'name',
                'business_name',
                'slogan',
                'email',
                'phone',
                'logo',
                'status'
            ],
            'url'
        ]);
    }

    /**
     * @testdox No existe la configuracion
     */
    public function test_configuration_read_no_exist()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $response = $this->json('GET', $this->baseUrl . "configurations/123");
        $response->assertStatus(404);
    }
}
