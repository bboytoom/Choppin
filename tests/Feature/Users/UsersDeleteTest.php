<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

/**
 * @testdox Accion eliminar en el modulo de usuario
 */
class UsersTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_user_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $user = $seed->seed_user();
        
        $this->json('DELETE', $this->baseUrl . "users/{$user->id}")->assertStatus(204);
    }
}
