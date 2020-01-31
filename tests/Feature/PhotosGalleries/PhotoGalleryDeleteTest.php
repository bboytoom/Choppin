<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PhotoGallery;

/**
 * @testdox Accion eliminar en el modulo de imagen de la galeria
 */
class PhotoGalleryDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_photo_gallery_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $photogallery = $seed->seed_gallery_photo();

        $this->json('DELETE', $this->baseUrl . "photosgalleries/{$photogallery['gallery_photo_id']}")->assertStatus(204);
    }
}
