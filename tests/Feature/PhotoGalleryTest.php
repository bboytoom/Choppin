<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PhotoGallery;

class PhotoGalleryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_photo_gallery_create()
    {
        $faker = \Faker\Factory::create();
        $seed = InitSeed::getInstance()->getSeed();
        $gallery = $seed->seed_gallery();

        $data = [
            'product_id' => $product['product_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'slide_default.png',
            'type' => 'image/png',
        ];
    }
}
