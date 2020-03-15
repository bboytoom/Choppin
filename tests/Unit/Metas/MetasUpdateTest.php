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
| 1) test_metas_update_optimo()
|
| 2) test_metas_update_max_limit_inferior()
|
| 3) test_metas_update_max_limit_superior()
|
| 4) test_metas_update_min_limit_inferior()
| 
| 5) test_metas_update_min_limit_superior()
|
| 6) test_metas_update_campos_requeridos()
|
| 7) test_metas_update_campos_id_no_exist()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Metas;

/**
 * @testdox Como usuario con rol de administrador quiero actualizar los metadatos de mi sitio
 */
class MetasUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para actualizar los metadatos
     */
    public function test_metas_update_optimo()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $metas = $seed->seed_metas();

        $keyword =  $faker->sentence($nbWords = 10, $variableNbWords = true);
        $description = $faker->text($maxNbChars = 100);

        $update = [
            'configuration_id' => $metas['configuration_id'],
            'keyword' => $keyword,
            'description' => $description
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/meta/{$metas['metas_id']}", $update);
        $response->assertStatus(200);

        $this->assertDatabaseHas('metas', [
            'keyword' => strtolower($keyword),
            'description' => strtolower($description)
        ]);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_metas_update_max_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $metas = $seed->seed_metas();

        $update = [
            'configuration_id' => $metas['configuration_id'],
            'keyword' => 'sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsdd',
            'description' => 'sjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjs'
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/meta/{$metas['metas_id']}", $update);
        $response->assertStatus(200);
    }    

    /**
     * @testdox Maximo numero de caracteres con limite superior  
     */
    public function test_metas_update_max_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $metas = $seed->seed_metas();

        $update = [
            'configuration_id' => $metas['configuration_id'],
            'keyword' => 'sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsd sjdksd sjkfjfjd jsdjsddss',
            'description' => 'sjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsdsjdksdsjdksdsjkfjfjdjsdjsss'
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/meta/{$metas['metas_id']}", $update);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite inferior 
     */
    public function test_metas_update_min_limit_inferior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $metas = $seed->seed_metas();

        $update = [
            'configuration_id' => $metas['configuration_id'],
            'keyword' => 'df',
            'description' => 'ds'
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/meta/{$metas['metas_id']}", $update);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite superior 
     */
    public function test_metas_update_min_limit_superior()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $metas = $seed->seed_metas();

        $update = [
            'configuration_id' => $metas['configuration_id'],
            'keyword' => 'dfsd',
            'description' => 'dsds'
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/meta/{$metas['metas_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Campos requeridos
     */
    public function test_metas_update_campos_requeridos()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $metas = $seed->seed_metas();

        $update = [
            'configuration_id' => $metas['configuration_id'],
            'keyword' => '',
            'description' => ''
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/meta/{$metas['metas_id']}", $update);
        $response->assertStatus(422);
    }

    /**
     * @testdox No  existe el dato
     */
    public function test_metas_update_campos_id_no_exist()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $metas = $seed->seed_metas();

        $keyword =  $faker->sentence($nbWords = 10, $variableNbWords = true);
        $description = $faker->text($maxNbChars = 100);

        $update = [
            'configuration_id' => 0,
            'keyword' => $keyword,
            'description' => $description
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/meta/{$metas['metas_id']}", $update);
        $response->assertStatus(422);
    }
}
