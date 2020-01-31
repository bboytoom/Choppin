<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryDeleteTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_category_delete()
    {
        $seed = InitSeed::getInstance()->getSeed();
        $category = $seed->seed_category();

        $this->json('DELETE', $this->baseUrl . "categories/{$category['category_id']}")->assertStatus(204);
    }
}
