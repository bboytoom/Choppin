<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Admin::class, 1)->create();
        
        factory(\App\Models\Configuration::class, 1)->create()->each(function ($configuration) {
            $configuration->photoconfiguration()->createMany(factory(\App\Models\PhotoSlide::class, 4)->make()->toArray());
        });

        factory(\App\User::class, 5)->create()->each(function ($user) {
            $user->shipping()->createMany(factory(\App\Models\Shipping::class, 2)->make()->toArray());
        });

        factory(\App\Models\Category::class, 5)->create()->each(function ($category) {
            $subcategoria = $category->subcategory()->saveMany(factory(\App\Models\SubCategory::class, 10)->make());
            $subcategoria->each(function ($subcat) {
                $product = $subcat->product()->saveMany(factory(\App\Models\Product::class, 10)->make());
                $product->each(function ($prod) {
                    $prod->characteristic()->createMany(factory(\App\Models\Characteristic::class, 6)->make()->toArray());
                    $prod->image()->createMany(factory(\App\Models\Photo::class, 4)->make()->toArray());
                });
            });

            $gallery = $category->gallery()->save(factory(\App\Models\Gallery::class)->make());
            $gallery->photogallery()->createMany(factory(\App\Models\PhotoGallery::class, 3)->make()->toArray());
        });
    }
}
