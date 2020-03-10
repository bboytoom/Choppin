<?php

namespace Tests\Feature;

/*
|--------------------------------------------------------------------------
| Slide principal (Indice)
|
| Descripcion: Muestra las imágenes que utilizan al inicio de la tienda
| Precondición: Es necesario que exista la configuración de la tienda
|--------------------------------------------------------------------------
|
| 1) test_photo_gallery_delete() 
|
| 2) test_photo_gallery_delete_no_id() 
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PhotoSlide;

/**
 * @testdox Como usuario con rol de administrador quiero eliminar una imagen por què ya no es necesaria
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

        $this->json('DELETE', $this->baseUrl . "configurations/slide/{$photoslide['slide_photo_id']}")->assertStatus(204);
    }

    /**
     * @testdox Parametros optimos
     */
    public function test_photo_gallery_delete_no_id() 
    {
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $this->json('DELETE', $this->baseUrl . "configurations/slide/343")->assertStatus(422);
    }
}
