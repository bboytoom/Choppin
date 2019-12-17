<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_create()
    {
        $seed = new SeedTest();
        $complemento = $seed->seed_subcategory();

        $data = [
           'admin_id' => $complemento['admin_id'],
           'category_id' => $complemento['category_id'],
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => 'Producto nueve',
           'extract' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
           'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quam arcu, eleifend eget condimentum ut, feugiat sed dui.',
           'price' => '250',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/admin/product', $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('products', $data);

        $product = Product::all()->first();

        $response->assertJson([
            'data' => [
                'product' => [
                    'name' => $product->name
                ]
            ]
        ]);
    }

    public function test_product_empty_create()
    {
        $seed = new SeedTest();
        $complemento = $seed->seed_subcategory();

        $data = [
           'admin_id' => $complemento['admin_id'],
           'category_id' => $complemento['category_id'],
           'subcategory_id' => $complemento['subcategoria_id']
        ];

        $response = $this->json('POST', '/api/admin/product', $data);
        $response->assertStatus(422);
    }

    public function test_product_min_field_create()
    {
        $seed = new SeedTest();
        $complemento = $seed->seed_subcategory();

        $data = [
           'admin_id' => $complemento['admin_id'],
           'category_id' => $complemento['category_id'],
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => 'producto',
           'extract' => 'Lor',
           'description' => 'Lre.',
           'price' => '12.50',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/admin/product', $data);
        $response->assertStatus(422);
    }

    public function test_product_max_field_create()
    {
        $seed = new SeedTest();
        $complemento = $seed->seed_subcategory();

        $data = [
           'admin_id' => $complemento['admin_id'],
           'category_id' => $complemento['category_id'],
           'subcategory_id' => $complemento['subcategoria_id'],
           'name' => 'blisanikichikitablisaniblisaniblisanikichikitablisaniblisanikichikitablisaniblisanikichikitablisaniblisanikichikitablisani',
           'extract' => 'blisanikichikitablisaniki',
           'description' => 'blisanikichikitablisanikichikitablisanikitablisani',
           'price' => '12.50',
           'status' => 1
        ];

        $response = $this->json('POST', '/api/admin/product', $data);
        $response->assertStatus(422);
    }

    public function test_product_update()
    {
        $seed = new SeedTest();
        $product = $seed->seed_product();

        $update = [
            'category_id' => $product['category_id'],
            'subcategory_id' => $product['subcategoria_id'],
            'name' => 'Producto uno',   
            'extract' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quam arcu, eleifend eget condimentum ut, feugiat sed dui.',
            'price' => '250',
            'status' => 1
        ];

        $response = $this->json('PUT', "/api/admin/product/{$product['product_id']}", $update);
        $response->assertStatus(200);

        $prod = Product::all()->first();

        $this->assertEquals($prod->name, $update['name']);
    }
    
    public function test_product_delete()
    {
        $seed = new SeedTest();
        $product = $seed->seed_product();

        $this->json('DELETE', "/api/admin/product/{$product['product_id']}")->assertStatus(204);
        $this->assertNull(Product::find($product['product_id']));
    }
}
