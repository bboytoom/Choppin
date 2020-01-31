<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Admin;

/**
 * @testdox Accion eliminar en el modulo de administracion
 */
class AdminsDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_admin_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_admin();

        $this->json('DELETE', $this->baseUrl . "admins/{$admin->id}")->assertStatus(204);
    }
}
