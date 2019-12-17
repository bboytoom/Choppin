<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use App\Admin;
use App\User;
use App\Models\Characteristic;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Shipping;

class SeedTest
{
    use RefreshDatabase;

    private $initial_user;
    private $initial_admin;
    private $initial_category;
    private $initial_subcategory;
    private $initial_product;
    private $initial_characteristic;
    private $initial_shipping;

    public function seed_characteristic()
    {
        $complemento = $this->seed_product();

        $characteristic = Characteristic::create([
            'admin_id' => $complemento['admin_id'],
            'product_id' => $complemento['product_id'],
            'name' => 'Caracteristica uno',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'status' => 1
        ]);

        $this->initial_characteristic = [
            'admin_id' => $complemento['admin_id'],
            'product_id' => $complemento['product_id'],
            'characteristic_id' => $characteristic->id,
            'name' => $characteristic->name
        ];

        return $this->initial_characteristic;
    }

    public function seed_product()
    {
        $complemento = $this->seed_subcategory();

        $product = Product::create([
            'admin_id' => $complemento['admin_id'],
            'category_id' => $complemento['category_id'],
            'subcategory_id' => $complemento['subcategoria_id'],
            'name' => 'Producto nueve',
            'slug' => Str::slug('Producto nueve', '-'),
            'extract' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quam arcu, eleifend eget condimentum ut, feugiat sed dui.',
            'price' => '250',
            'status' => 1
        ]);

        $this->initial_product = [
            'admin_id' => $complemento['admin_id'],
            'category_id' => $complemento['category_id'],
            'subcategoria_id' => $complemento['subcategoria_id'],
            'product_id' => $product->id,
            'name' => $product->name
        ];

        return $this->initial_product;
    }

    public function seed_subcategory()
    {
        $category = $this->seed_category();

        $subcategory = SubCategory::create([
            'admin_id' => $category['admin_id'],
            'category_id' => $category['category_id'],
            'name' => 'Subcategoria',
            'slug' => Str::slug('Subcategoria', '-'),
            'description' => 'Es una subcategoria de prueba',
            'status' => 1
        ]);

        $this->initial_subcategory = [
            'admin_id' => $category['admin_id'],
            'category_id' => $category['category_id'],
            'subcategoria_id' => $subcategory->id,
        ];

        return $this->initial_subcategory;
    }

    public function seed_category()
    {
        $admin = $this->seed_admin();

        $categoria = Category::create([
            'admin_id' => $admin->id,
            'name' => 'Categoria dos',
            'slug' => Str::slug('Categoria dos', '-'),
            'description' => 'Es una categoria dos de prueba',
            'status' => 1
        ]);

        $this->initial_category = [
            'admin_id' => $admin->id,
            'category_id' => $categoria->id
        ];

        return $this->initial_category;
    }

    public function seed_admin()
    {
        $this->initial_admin = Admin::create([
           'name' => 'productadmin',
           'mother_surname' => 'materno',
           'father_surname' => 'paterno',
           'email' => 'productadmin@correo.com',
           'password' => \Hash::make('@Admins2907'),
           'status' => 1
        ]);

        return $this->initial_admin;
    }

    public function seed_shipping()
    {
        $user = $this->seed_user();

        $shipping = Shipping::create([
            'user_id' => $user->id,
            'street_one' => 'calle uno',
            'street_two' => 'calle dos',
            'addres' => 'mi casita :)',
            'suburb' => 'En un lugar de iztapalapa',
            'town' => 'iztapalapa',
            'state' => 'ciudad de mexico',
            'country' => 'mexico',
            'postal_code' => '08921',
            'status' => 1
        ]);

        $this->initial_shipping = [
            'user_id' => $user->id,
            'shipping_id' => $shipping->id
        ];

        return $this->initial_shipping;
    }

    public function seed_user()
    {
        $this->initial_user = User::create([
           'name' => 'chikita',
           'mother_surname' => 'materno',
           'father_surname' => 'paterno',
           'email' => 'chikita@correo.com',
           'password' => \Hash::make('@Admins2907'),
           'status' => 1
        ]);

        return $this->initial_user;
    }
}
