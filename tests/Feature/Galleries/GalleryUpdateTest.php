<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Gallery;

/**
 * @testdox Accion actualizar en el modulo de galeria de la categoria
 */
class GalleryUpdateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_gallery_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $update = [
            'category_id' => $gallery['category_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'active' => 1,
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "galleries/{$gallery['gallery_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox nombre de la galeria similar
     */
    public function test_gallery_same_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $update = [
            'category_id' => $gallery['category_id'],
            'name' => $gallery['name'],
            'active' => 1,
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "galleries/{$gallery['gallery_id']}", $update);
        $response->assertStatus(200);
    }

    /**
     * @testdox no existe la categoria 
     */
    public function test_gallery_category_no_exist_update()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $update = [
            'category_id' => 0,
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'active' => 1,
            'status' => 1
        ];

        $response = $this->json('PUT', $this->baseUrl . "galleries/{$gallery['gallery_id']}", $update);
        $response->assertStatus(422);
    }
}
