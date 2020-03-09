<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Configuración (Indice)
|
| Descripcion: Muestra la información de la tienda por ejemplo, el nombre de la tienda, el dominio , etc..
|--------------------------------------------------------------------------
|
| 1) test_configuration_update_optimo()
|
| 2) test_configuration_update_optimo_opcionales()
|
| 3) test_configuration_update_optimo_opcionales_empty()
|
| 4) test_configuration_dominio_same_update()
|
| 5) test_configuration_name_same_update()
|
| 6) test_configuration_email_same_update()
|
| 7) test_configuration_phone_same_update()
|
| 8) test_configuration_update_estatus_deshabilitado()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Configuration;

/**
 * @testdox Como usuario con rol de administrador quiero actualizar la información de la tienda
 */
class ConfigurationUpdateTest extends TestCase
{ 
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo
     */
    public function test_configuration_update_optimo()
    {
        $faker = \Faker\Factory::create();

        $update = [
            'domain' => $faker->domainName,
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => $faker->text($maxNbChars = 100),
            'email' => $faker->email,
            'logo' => 'logo.png',
            'phone' => $faker->tollFreePhoneNumber
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $response = $this->json('PUT', $this->baseUrl . "configurations/{$configuration['configuration_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Caso optimo sin opcionales
     */
    public function test_configuration_update_optimo_opcionales()
    {
        $faker = \Faker\Factory::create();

        $update = [
            'domain' => $faker->domainName,
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'email' => $faker->email,
            'logo' => 'logo.png',
            'phone' => $faker->tollFreePhoneNumber
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $response = $this->json('PUT', $this->baseUrl . "configurations/{$configuration['configuration_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Caso optimo con opcionales vacios
     */
    public function test_configuration_update_optimo_opcionales_empty()
    {
        $faker = \Faker\Factory::create();

        $update = [
            'domain' => $faker->domainName,
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => '',
            'email' => $faker->email,
            'logo' => 'logo.png',
            'phone' => $faker->tollFreePhoneNumber
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $response = $this->json('PUT', $this->baseUrl . "configurations/{$configuration['configuration_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox El dominio de la tienda debe ser único
     */
    public function test_configuration_dominio_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();

        $configuration = $seed->seed_configuration();

        $update = [
            'domain' => $configuration['domain'],
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => $faker->text($maxNbChars = 100),
            'logo' => 'logo.png',
            'email' => $faker->email,
            'phone' => $faker->tollFreePhoneNumber
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/{$configuration['configuration_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox El nombre de la tienda debe ser único
     */
    public function test_configuration_name_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();

        $configuration = $seed->seed_configuration();

        $update = [
            'domain' => $faker->domainName,
            'name' => $configuration['name'],
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => $faker->text($maxNbChars = 100),
            'logo' => 'logo.png',
            'email' => $faker->email,
            'phone' => $faker->tollFreePhoneNumber
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/{$configuration['configuration_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox El correo debe ser único
     */
    public function test_configuration_email_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();

        $configuration = $seed->seed_configuration();

        $update = [
            'domain' => $faker->domainName,
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => $faker->text($maxNbChars = 100),
            'logo' => 'logo.png',
            'email' => $configuration['email'],
            'phone' => $faker->tollFreePhoneNumber
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/{$configuration['configuration_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox El teléfono debe ser único
     */
    public function test_configuration_phone_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();

        $configuration = $seed->seed_configuration();

        $update = [
            'domain' => $faker->domainName,
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => $faker->text($maxNbChars = 100),
            'logo' => 'logo.png',
            'email' => $faker->email,
            'phone' => $configuration['phone']
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/{$configuration['configuration_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Configuracion con estatus deshabilitado
     */
    public function test_configuration_update_estatus_deshabilitado()
    {
        $faker = \Faker\Factory::create();

        $update = [
            'domain' => $faker->domainName,
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => $faker->text($maxNbChars = 100),
            'email' => $faker->email,
            'logo' => 'logo.png',
            'phone' => $faker->tollFreePhoneNumber,
            'status' => 0
        ];

        $seed = InitSeed::getInstance()->getSeed();
        $configuration = $seed->seed_configuration();

        $response = $this->json('PUT', $this->baseUrl . "configurations/{$configuration['configuration_id']}", $update);
        $response->assertStatus(200);
    }
}
