<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Admin;

class AdminsDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_admin_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $admin = $seed->seed_admin();

        $this->json('DELETE', $this->baseUrl . "admins/{$admin->id}")->assertStatus(204);
    }
}
