<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Admin;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_subcategory_create()
    {
        $seed = new SeedTest();
        $category = $seed->seed_category();

        $data = [
           'admin_id' => $category['admin_id'],
           'category_id' => $category['category_id'],
           'name' => 'Subcategoria uno',
           'description' => 'Es una subcategoria de prueba',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/admin/subcategory', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('sub_categories', $data);

        $subcategory = SubCategory::all()->first();

        $response->assertJson([
            'data' => [
                'subcategory' => [
                    'name' => $subcategory->name
                ]
            ]
        ]);
    }   

    public function test_subcategory_update()
    {
        $seed = new SeedTest();
        $subcategory = $seed->seed_subcategory();

        $update = [
            'category_id' => $subcategory['category_id'],
            'name' => 'Subcategoria dos',
            'description' => 'Es una subcategoria dos de prueba',
            'status' => 1
        ];

        $response = $this->json('PUT', "/api/admin/subcategory/{$subcategory['subcategoria_id']}", $update);
        $response->assertStatus(200);

        $subcat = SubCategory::all()->first();

        $this->assertEquals($subcat->name, $update['name']);
    }

    public function test_subcategory_delete()
    {
        $seed = new SeedTest();
        $subcategory = $seed->seed_subcategory();

        $this->json('DELETE', "/api/admin/subcategory/{$subcategory['subcategoria_id']}")->assertStatus(204);
        $this->assertNull(SubCategory::find($subcategory['subcategoria_id']));
    }
}
