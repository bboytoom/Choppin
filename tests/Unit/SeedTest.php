<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use App\Models\Configuration;
use App\User;
use App\Models\Characteristic;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Photo;
use App\Models\PhotoSlide;
use App\Models\Metas;
use App\Models\Shipping;

class SeedTest
{
    use RefreshDatabase, WithFaker;

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

        return [
            'product_id' => $catalogs['product_id'],
            'characteristic_id' => $characteristic->id,
            'name' => $characteristic->name
        ];
    }

    public function seed_metas()
    {
        $faker = \Faker\Factory::create();
        $configuration = $this->seed_configuration();
        
        $meta = Metas::create([
            'configuration_id' => $configuration['configuration_id'],
            'keyword' => $faker->sentence($nbWords = 10, $variableNbWords = true),
            'description' => $faker->text($maxNbChars = 100)
        ]);

        return [
            'configuration_id' => $configuration['configuration_id'],
            'metas_id' => $meta->id,
            'keyword' => $meta->keyword,
            'description' => $meta->description
        ];
    }

    public function seed_slide_photo()
    {
        $faker = \Faker\Factory::create();
        $configuration = $this->seed_configuration();
        $name = $faker->unique()->sentence($nbWords = 2, $variableNbWords = true);

        $photoslide = PhotoSlide::create([
            'configuration_id' => $configuration['configuration_id'],
            'name' => $name,
            'image' => 'slide_default.jpg',
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ]);

        return [
            'configuration_id' => $configuration['configuration_id'],
            'slide_photo_id' => $photoslide->id,
            'name' => $photoslide->name
        ];
    }

    public function seed_photo()
    {
        $faker = \Faker\Factory::create();
        $catalogs = $this->seed_product();

        $photo = Photo::create([
            'product_id' => $catalogs['product_id'],
            'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
            'image' => 'producto_default.png',
            'description' => $faker->text($maxNbChars = 250),
            'status' => 1
        ]);

        return [
            'product_id' => $catalogs['product_id'],
            'photo_id' => $photo->id,
            'name' => $photo->name
        ];
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

        return [
            'category_id' => $catalogs['category_id'],
            'subcategoria_id' => $catalogs['subcategoria_id'],
            'product_id' => $product->id,
            'name' => $product->name
        ];
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

        return [
            'category_id' => $category['category_id'],
            'subcategoria_id' => $subcategory->id,
            'name' => $subcategory->name,
        ];
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

        return [
            'category_id' => $category->id,
            'name' => $category->name,
            'description' => $category->description
        ];
    }

    public function seed_shipping()
    {
        $faker = \Faker\Factory::create();
        $user = $this->seed_administrator_cliente();

        $shipping = Shipping::create([
            'user_id' => $user->id,
            'street_one' => $faker->streetAddress,
            'street_two' => $faker->streetAddress,
            'addres' => $faker->address,
            'suburb' => $faker->citySuffix,
            'town' => $faker->city,
            'state' => $faker->state,
            'country' => 'mexico',
            'postal_code' => $faker->numerify('0 ####')
        ]);

        return [
            'user_id' => $user->id,
            'shipping_id' => $shipping->id
        ];
    }

    public function seed_administrator_staff()
    {
        $faker = \Faker\Factory::create();

        return User::create([
           'type' => 'staff',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => \Hash::make('@Staff2907'),
           'password_confirmation' => \Hash::make('@Staff2907'),
           'status' => 1
        ]);
    }

    public function seed_administrator_admin()
    {
        $faker = \Faker\Factory::create();

        return User::create([
           'type' => 'administrador',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => \Hash::make('@Admin2907'),
           'password_confirmation' => \Hash::make('@Admin2907'),
           'status' => 1
        ]);
    }

    public function seed_administrator_cliente()
    {
        $faker = \Faker\Factory::create();

        return User::create([
           'type' => 'cliente',
           'name' => $faker->name,
           'mother_surname' => $faker->lastName,
           'father_surname' => $faker->lastName,
           'email' => $faker->unique()->safeEmail,
           'password' => \Hash::make('@Cliente2907'),
           'password_confirmation' => \Hash::make('@Cliente2907'),
           'status' => 1
        ]);
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

        return [
            'configuration_id' => $configuration->id,
            'domain' => $configuration->domain,
            'name' => $configuration->name,
            'email' => $configuration->email,
            'phone' => $configuration->phone,
            'slogan' => $configuration->slogan
        ];
    }
}
