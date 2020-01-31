<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_product_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $product = $seed->seed_product();

        $this->json('DELETE', $this->baseUrl . "products/{$product['product_id']}")->assertStatus(204);
    }
}
