<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Metas (Indice)
|
| Descripcion: Muestran información a los buscadores
| Precondición: Es necesario que exista la configuración de la tienda
|--------------------------------------------------------------------------
|
| 1) test_metas_read_index()
|
| 2) test_metas_read_show()
|
| 3) test_metas_read_no_exist()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Metas;

/**
 * @testdox Como usuario con rol de administrador quiero visualizar los metadatos del sitio
 */
class MetasReadTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Muestra mis metadatos
     */
    public function test_metas_read_index()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $metas = $seed->seed_metas();
       
        $response = $this->json('GET', $this->baseUrl . "configurations/meta/all/{$metas['configuration_id']}");
        $response->assertStatus(200);
    }

    /**
     * @testdox Muestra los detalles de los metadatos
     */
    public function test_metas_read_show()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $metas = $seed->seed_metas();

        $response = $this->json('GET', $this->baseUrl . "configurations/meta/{$metas['metas_id']}");
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'type',
            'id',
            'attributes' => [
                'keyword',
                'description'
            ]
        ]);
    }

    /**
     * @testdox No existe el metadato
     */
    public function test_metas_read_no_exist()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $metas = $seed->seed_metas();

        $response = $this->json('GET', $this->baseUrl . "configurations/meta/123");
        $response->assertStatus(404);
    }
}
