<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Imágenes del producto (Indice)
|
| Descripcion: Muestra las imágenes de los productos
| Precondición: Es necesario que el producto se haya creado con anterioridad
|--------------------------------------------------------------------------
|
| 1) test_photo_delete()
|
| 2) test_photo_delete_no_id()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Photo;

/**
 * @testdox Como usuario con rol de administrador quiero eliminar una imagen por què ya no es necesaria
 */
class PhotoDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo
     */
    public function test_photo_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $photo = $seed->seed_photo();

        $this->json('DELETE', $this->baseUrl . "products/photos/{$photo['photo_id']}")->assertStatus(204);
    }

    /**
     * @testdox La imagen del producto no existe
     */
    public function test_photo_delete_no_id()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $photo = $seed->seed_photo();

        $this->json('DELETE', $this->baseUrl . "products/photos/232")->assertStatus(422);
    }
}
