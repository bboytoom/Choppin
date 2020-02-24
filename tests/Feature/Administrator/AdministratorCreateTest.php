<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Administradores (Indice)
|
| Descripcion: El módulo de administradores contiene los datos de los usuarios con el rol de STAFF y ADMINISTRADOR
|--------------------------------------------------------------------------
|
| 1) test_administrator_create_optimo()
| 
| 2) test_administrator_create_sin_opcionales()
| 
| 3) test_administrador_create_max_limit_inferior()
| 
| 4) test_administrador_create_max_limit_superior()
|
| 5) test_administrador_create_min_limit_inferior()
|
| 6) test_administrador_create_min_limit_superior()
|
| 7) test_administrador_create_email_fail()
|
| 8) test_administrador_email_same_create()
|
| 9) test_administrator_create_vacio()
|
| 10) test_administrator_create_administrador()
|
| 11) test_administrator_create_deshabilitado()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * 
 * @testdox Como usuario con rol de administrador quiero crear un usuario con rol de staff para ayudarme en la gestión de la tienda.
 * 
 */
class AdministratorCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo para crear un usuario con rol de staff
     */
    public function test_administrator_create_optimo()
    {
        $faker = \Faker\Factory::create();

        $correo = $faker->unique()->safeEmail;

        $data = [
           'type' => 'staff',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $correo,
           'password' => '@Staff2907',
           'password_confirmation' => '@Staff2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(201);
    
        $this->assertDatabaseHas('users', [
            'email' => $correo,
        ]);
    }

    /**
     * @testdox El apellido materno es opcional
     */
    public function test_administrator_create_sin_opcionales()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->name,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => '@Staff2907',
           'password_confirmation' => '@Staff2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'mother_surname' => '',
        ]);
    }

    /**
     * @testdox Maximo numero de caracteres con limite inferior 
     */
    public function test_administrador_create_max_limit_inferior()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->text($maxNbChars = 48),
           'mother_surname' => $faker->text($maxNbChars = 38),
           'father_surname' => $faker->text($maxNbChars = 38),
           'email' => $faker->unique()->safeEmail,
           'password' => '@Staff2907',
           'password_confirmation' => '@Staff2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Maximo numero de caracteres con limite superior 
     */
    public function test_administrador_create_max_limit_superior()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => 'Consecteturhjsfacereprovidenterrorprovidentdeserun',
           'mother_surname' => 'Consecteturhjsfacereprovidenterrorprsfd', 
           'father_surname' => 'Consecteturhjsfacereprovidenterrorprsfd',
           'email' => $faker->unique()->safeEmail,
           'password' => '@Staff2907',
           'password_confirmation' => '@Staff2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite inferior 
     */
    public function test_administrador_create_min_limit_inferior()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => 'as',
           'mother_surname' => 'dfg',
           'father_surname' => 'dfg',
           'email' => $faker->unique()->safeEmail,
           'password' => '@Staff2907',
           'password_confirmation' => '@Staff2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Minimo numero de caracteres con limite superior 
     */
    public function test_administrador_create_min_limit_superior()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->text($maxNbChars = 5),
           'mother_surname' => $faker->text($maxNbChars = 5),
           'father_surname' => $faker->text($maxNbChars = 5),
           'email' => $faker->unique()->safeEmail,
           'password' => '@Staff2907',
           'password_confirmation' => '@Staff2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox Correo no valido
     */
    public function test_administrador_create_email_fail()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => 'correonovalido.com',
           'password' => '@Staff2907',
           'password_confirmation' => '@Staff2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox El correo debe ser único.
     */
    public function test_administrador_email_same_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user_staff = $seed->seed_administrator_staff();
        
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $user_staff->email,
           'password' => '@Staff2907',
           'password_confirmation' => '@Staff2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox No se ingreso ningun tipo de dato
     */
    public function test_administrator_create_vacio()
    {
        $data = [];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Solo puede existir un usuario con rol de administrador
     */
    public function test_administrator_create_administrador()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'administrador',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => '@Staff2907',
           'password_confirmation' => '@Staff2907'
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox Cuando se crea el nuevo usuario su estado predeterminado es activo
     */
    public function test_administrator_create_deshabilitado()
    {
        $faker = \Faker\Factory::create();

        $data = [
           'type' => 'staff',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => '@Staff2907',
           'password_confirmation' => '@Staff2907',
           'status' => 0
        ];

        $response = $this->json('POST', $this->baseUrl . 'administration', $data);
        $response->assertStatus(201);
       
        $this->assertDatabaseHas('users', [
            'status' => 1,
        ]);
    }
}
