<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Gallery;

/**
 * @testdox Accion crear en el modulo de galeria de la categoria
 */
class GalleryCreateTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * @testdox Parametros optimos
     */
    public function test_gallery_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
            'category_id' => $category['category_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'active' => 1,
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'galleries', $data);
        $response->assertStatus(201);
    }

    /**
     * @testdox nombre de la galeria similar
     */
    public function test_gallery_same_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $data = [
            'category_id' => $gallery['category_id'],
            'name' => $gallery['name'],
            'active' => 1,
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'galleries', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox no existe la categoria 
     */
    public function test_gallery_category_no_exist_create()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'category_id' => 0,
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'active' => 1,
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'galleries', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox sobrepasa los caracteres requeridos
     */
    public function test_gallery_max_field_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
            'category_id' => $category['category_id'],
            'name' => $faker->text($maxNbChars = 200),
            'active' => 1,
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'galleries', $data);
        $response->assertStatus(422);
    }

    /**
     * @testdox no cuenta con el minimo de caracteres requeridos
     */                            
    public function test_gallery_min_field_create()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $data = [
            'category_id' => $category['category_id'],
            'name' => 's',
            'active' => 1,
            'status' => 1
        ];

        $response = $this->json('POST', $this->baseUrl . 'galleries', $data);
        $response->assertStatus(422);
    }
}
