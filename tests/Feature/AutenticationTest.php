<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Autenticación (Indice)
|
| Descripcion: El módulo de autenticación valida las credenciales del usuario y da acceso a los recursos del sistema
|--------------------------------------------------------------------------
|
| 1) test_autenticacion_optima_administrador()
|
| 2) test_autenticacion_optima_staff()
|
| 3) test_autenticacion_optima_cliente()
|
| 4) test_autenticacion_password_fail()
|
| 5) test_autenticacion_vacio()
|
| 6) test_autenticacion_password_fail_multi()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * 
 * @testdox Como usuario quiero ingresar al panel de administración para gestionar mi información.
 * 
 */
class AutenticationTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para autenticar un usuario con rol de administrador
     */
    public function test_autenticacion_optima_administrador()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_admin();

        $data = [
            'email' => $admin->email,
            'password' => '@Admin2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'login', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /**
     * @testdox Caso optimo para autenticar un usuario con rol de staff
     */
    public function test_autenticacion_optima_staff()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_staff();

        $data = [
            'email' => $admin->email,
            'password' => '@Staff2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'login', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /**
     * @testdox Caso optimo para autenticar un usuario con rol de cliente
     */
    public function test_autenticacion_optima_cliente()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_cliente();

        $data = [
            'email' => $admin->email,
            'password' => '@Cliente2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'login', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
    }

    /**
     * @testdox Contraseña equivocada
     */
    public function test_autenticacion_password_fail()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_admin();

        $data = [
            'email' => $admin->email,
            'password' => '@PruebaJAJA'
        ];

        $response = $this->json('POST', $this->baseUrl . 'login', $data);
        $response->assertStatus(401);
    }

    /**
     * @testdox Si tengo tres intentos fallidos mi cuenta se bloquea por 15 minutos
     */
    public function test_autenticacion_password_fail_multi()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_admin();
        $correo = $admin->email;

        for($i = 0; $i < 3; $i++) {
            $data = [
                'email' => $correo,
                'password' => '@PruebaJAJA'
            ];

            $response = $this->json('POST', $this->baseUrl . 'login', $data);
            $response->assertStatus(401);
        }

        $data = [
            'email' => $correo,
            'password' => '@PruebaJAJA'
        ];

        $response = $this->json('POST', $this->baseUrl . 'login', $data);
        $response->assertStatus(429);
    }

    /**
     * @testdox Las credenciales son obligatorias
     */
    public function test_autenticacion_vacio()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_administrator_admin();

        $data = [
            'email' => '',
            'password' => ''
        ];

        $response = $this->json('POST', $this->baseUrl . 'login', $data);
        $response->assertStatus(422);
    }
}
