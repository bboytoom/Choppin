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
| 1) test_photo_update()
|
| 2) test_photo_same_update()
|
| 3) test_photo_same_product_no_exist_update()
|
| 4) test_photo_update_estatus_deshabilitado()
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Photo;

/**
 * @testdox Como usuario con rol de administrador quiero actualizar una imagen por què ya no es necesaria
 */
class PhotoUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo
     */
    public function test_photo_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photo = $seed->seed_photo();
       
        $update = [
            'product_id' => $photo['product_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'producto_default.png',
            'type' => 'image/png',
            'base' => create_image_producto(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "products/photos/{$photo['photo_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Nombre de la imagen similar
     */
    public function test_photo_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photo = $seed->seed_photo();

        $update = [
            'product_id' => $photo['product_id'],
            'name' => $photo['name'],
            'image' => 'producto_default.png',
            'type' => 'image/png',
            'base' => create_image_producto(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];
        
        $response = $this->json('PUT', $this->baseUrl . "products/photos/{$photo['photo_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox No existe el producto 
     */
    public function test_photo_same_product_no_exist_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photo = $seed->seed_photo();

        $update = [
            'product_id' => 0,
            'name' => $photo['name'],
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "products/photos/{$photo['photo_id']}", $update);
        $response->assertStatus(422);
    }

    /**
     * @testdox Imagen de producto con estatus deshabilitado
     */
    public function test_photo_update_estatus_deshabilitado()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photo = $seed->seed_photo();

        $update = [
            'product_id' => $photo['product_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'producto_default.png',
            'type' => 'image/png',
            'base' => create_image_producto(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 0
        ];

        $response = $this->json('PUT', $this->baseUrl . "products/photos/{$photo['photo_id']}", $update);
        $response->assertStatus(200);
    }
}
