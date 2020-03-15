<?php

namespace Tests\Unit;

/*
|--------------------------------------------------------------------------
| Slide principal (Indice)
|
| Descripcion: Muestra las imágenes que utilizan al inicio de la tienda
| Precondición: Es necesario que exista la configuración de la tienda
|--------------------------------------------------------------------------
|
| 1) test_photo_slide_update_optimo() 
|
| 2) test_photo_slide_update_optimo_opcionales() 
|
| 3) test_photo_slide_update_optimo_opcionales_empty() 
|
| 4) test_photo_slide_same_update() 
|
| 5) test_photo_slide_no_exist_update() 
|
| 6) test_photo_slide_update_estatus_deshabilitado() 
|
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PhotoSlide;

/**
 * @testdox Como usuario con rol de administrador quiero actualizar una imagen para el slide principal por què me equivoque
 */
class PhotoSlideUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Caso optimo
     */
    public function test_photo_slide_update_optimo() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $update = [
            'configuration_id' => $photoslide['configuration_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 200),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/slide/{$photoslide['slide_photo_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Caso optimo sin opcionales
     */
    public function test_photo_slide_update_optimo_opcionales() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $update = [
            'configuration_id' => $photoslide['configuration_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/slide/{$photoslide['slide_photo_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox Caso optimo con la descripcion vacia
     */
    public function test_photo_slide_update_optimo_opcionales_empty() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $update = [
            'configuration_id' => $photoslide['configuration_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => '',
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/slide/{$photoslide['slide_photo_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox nombre de la imagen similar
     */
    public function test_photo_slide_same_update() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $update = [
            'configuration_id' => $photoslide['configuration_id'],
            'name' => $photoslide['name'],
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/slide/{$photoslide['slide_photo_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox no existe la configuracion 
     */
    public function test_photo_slide_no_exist_update() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $update = [
            'configuration_id' => 0,
            'name' => $photoslide['name'],
            'image' => 'slide_default.jpg',
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/slide/{$photoslide['slide_photo_id']}", $update);
        $response->assertStatus(422);
    }

    /**
     * @testdox Imagen del slide principal con estatus deshabilitado
     */
    public function test_photo_slide_update_estatus_deshabilitado() 
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $photoslide = $seed->seed_slide_photo();

        $update = [
            'configuration_id' => $photoslide['configuration_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.jpg',
            'type' => 'image/jpeg',
            'base' => create_image_slide(),
            'description' => $faker->text($maxNbChars = 200),
            'status' => 0
        ];

        $response = $this->json('PUT', $this->baseUrl . "configurations/slide/{$photoslide['slide_photo_id']}", $update);
        $response->assertStatus(200);
    }
}
