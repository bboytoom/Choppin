<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use App\Models\Configuration;
use App\Admin;
use App\User;
use App\Models\Characteristic;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Shipping;

class SeedTest
{
    use RefreshDatabase, WithFaker;
    
    private $initial_configuration;
    private $initial_user;
    private $initial_admin;
    private $initial_category;
    private $initial_subcategory;
    private $initial_product;
    private $initial_characteristic;
    private $initial_shipping;

    public function seed_characteristic()
    {
        $faker = \Faker\Factory::create();
        $catalogs = $this->seed_product();

        $characteristic = Characteristic::create([
            'product_id' => $catalogs['product_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ]);

        $this->initial_characteristic = [
            'product_id' => $catalogs['product_id'],
            'characteristic_id' => $characteristic->id,
            'name' => $characteristic->name
        ];

        return $this->initial_characteristic;
    }

    public function seed_product()
    {
        $faker = \Faker\Factory::create();
        $catalogs = $this->seed_subcategory();
        $prod = $faker->unique()->sentence($nbWords = 2, $variableNbWords = true);

        $product = Product::create([
            'subcategory_id' => $catalogs['subcategoria_id'],
            'name' => $prod,
            'slug' => Str::slug($prod, '-'),
            'extract' => $faker->text($maxNbChars = 50),
            'description' => $faker->text($maxNbChars = 250),
            'price' => $faker->numberBetween($min = 100, $max = 1000),
            'status' => 1
        ]);

        $this->initial_product = [
            'category_id' => $catalogs['category_id'],
            'subcategoria_id' => $catalogs['subcategoria_id'],
            'product_id' => $product->id,
            'name' => $product->name
        ];

        return $this->initial_product;
    }

    public function seed_subcategory()
    {
        $faker = \Faker\Factory::create();
        $category = $this->seed_category();
        $subcat = $faker->unique()->sentence($nbWords = 2, $variableNbWords = true);

        $subcategory = SubCategory::create([
            'category_id' => $category['category_id'],
            'name' => $subcat,
            'slug' => Str::slug($subcat, '-'),
            'description' => $faker->text($maxNbChars = 50),
            'status' => 1
        ]);

        $this->initial_subcategory = [
            'category_id' => $category['category_id'],
            'subcategoria_id' => $subcategory->id,
            'name' => $subcategory->name,
        ];

        return $this->initial_subcategory;
    }

    public function seed_category()
    {
        $faker = \Faker\Factory::create();
        $cat = $faker->unique()->sentence($nbWords = 2, $variableNbWords = true);

        $category = Category::create([
            'name' => $cat,
            'slug' => Str::slug($cat, '-'),
            'description' => $faker->text($maxNbChars = 50),
            'status' => 1
        ]);

        $this->initial_category = [
            'category_id' => $category->id,
            'name' => $category->name
        ];

        return $this->initial_category;
    }

    public function seed_admin()
    {
        $faker = \Faker\Factory::create();
        
        $this->initial_admin = Admin::create([
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => \Hash::make('@Admins2907'),
           'status' => 1
        ]);

        return $this->initial_admin;
    }

    public function seed_shipping()
    {
        $faker = \Faker\Factory::create();
        $user = $this->seed_user();

        $shipping = Shipping::create([
            'user_id' => $user->id,
            'street_one' => $faker->streetAddress,
            'street_two' => $faker->streetAddress,
            'addres' => $faker->address,
            'suburb' => $faker->citySuffix,
            'town' => $faker->city,
            'state' => $faker->state,
            'country' => 'mexico',
            'postal_code' => $faker->numerify('0 ####'),
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
        $faker = \Faker\Factory::create();

        $this->initial_user = User::create([
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => \Hash::make('@Admins2907'),
           'status' => 1
        ]);

        return $this->initial_user;
    }

    public function seed_configuration()
    {
        $faker = \Faker\Factory::create();

        $configuration = Configuration::create([
            'domain' => $faker->domainName,
            'name' => $faker->domainWord,
            'business_name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'slogan' => $faker->text($maxNbChars = 100),
            'logo' => 'prueba.png',
            'email' => $faker->email,
            'phone' => $faker->tollFreePhoneNumber,
            'status' => 1
        ]);

        $this->initial_configuration = [
            'configuration_id' => $configuration->id,
            'domain' => $configuration->domain
        ];

        return $this->initial_configuration;
    }
}
