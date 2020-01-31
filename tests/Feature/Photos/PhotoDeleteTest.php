<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Photo;

/**
 * @testdox Accion eliminar en el modulo de imagenes del producto
 */
class PhotoDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_photo_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $photo = $seed->seed_photo();

        $this->json('DELETE', $this->baseUrl . "photos/{$photo['photo_id']}")->assertStatus(204);
    }
}
