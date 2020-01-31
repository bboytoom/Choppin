<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PhotoSlide;

/**
 * @testdox Accion crear en el modulo de imagenes del slide
 */
class PhotoSlideDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_photo_gallery_delete() 
    {
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $this->json('DELETE', $this->baseUrl . "photoslide/{$photoslide['slide_photo_id']}")->assertStatus(204);
    }
}
