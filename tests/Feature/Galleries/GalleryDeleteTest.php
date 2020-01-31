<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Gallery;

/**
 * @testdox Accion eliminar en el modulo de galeria de la categoria
 */
class GalleryDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_gallery_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $this->json('DELETE', $this->baseUrl . "galleries/{$gallery['gallery_id']}")->assertStatus(204);
    }
}
