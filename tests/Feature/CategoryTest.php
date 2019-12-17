<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Admin;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_create()
    {
        $seed = new SeedTest();
        $admin = $seed->seed_admin();

        $data = [
           'admin_id' => $admin->id,
           'name' => 'Categoria uno',
           'description' => 'Esta es la categoria tres',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/category', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('categories', $data);

        $category = Category::all()->first();

        $response->assertJson([
            'data' => [
                'category' => [
                    'name' => $category->name
                ]
            ]
        ]);
    }

    public function test_category_max_field_create()
    {
        $seed = new SeedTest();
        $admin = $seed->seed_admin();

        $data = [
            'admin_id' => $admin->id,
            'name' => 'blisanikichikitablisanikichikitablisanikichikitablisanikichikitablisanikichikitablisanikichikitablisanikichikita',
            'description' => 'paternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaternopaterno',
            'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/category', $data);
        $response->assertStatus(422);
    }

    public function test_category_min_field_create()
    {
        $seed = new SeedTest();
        $admin = $seed->seed_admin();

        $data = [
            'admin_id' => $admin->id,
            'name' => 'a',
            'description' => 's',
            'status' => 1
        ];

        $response = $this->json('POST', '/api/v1/category', $data);
        $response->assertStatus(422);
    }

    public function test_category_empty_create()
    {
        $data = [];

        $response = $this->json('POST', '/api/v1/category', $data);
        $response->assertStatus(422);
    }

    public function test_category_update()
    {
        $update = [
           'name' => 'categoria uno editados',
           'description' => 'Es una categoria de prueba',
           'status' => 1
        ];

        $seed = new SeedTest();
        $category = $seed->seed_category();

        $response = $this->json('PUT', "/api/v1/category/{$category['category_id']}", $update);
        $response->assertStatus(200);

        $cate = Category::all()->first();
        
        $this->assertEquals($cate->name, $update['name']);
    }

    public function test_category_delete()
    {
        $seed = new SeedTest();
        $category = $seed->seed_category();

        $this->json('DELETE', "/api/v1/category/{$category['category_id']}")->assertStatus(204);
        $this->assertNull(Category::find($category['category_id']));
    }
}
