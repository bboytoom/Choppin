<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PhotoGallery;

class PhotoGalleryDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_photo_gallery_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $photogallery = $seed->seed_gallery_photo();

        $this->json('DELETE', $this->baseUrl . "photosgalleries/{$photogallery['gallery_photo_id']}")->assertStatus(204);
    }
}
