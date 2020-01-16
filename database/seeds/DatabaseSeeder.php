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
        
        factory(\App\Models\Configuration::class, 1)->create();

        factory(\App\User::class, 50)->create()->each(function ($user) {
            $user->shipping()->createMany(factory(\App\Models\Shipping::class, 2)->make()->toArray());
        });

        factory(\App\Models\Category::class, 10)->create()->each(function ($category) {
            $category->subcategory()->createMany(factory(\App\Models\SubCategory::class, 20)->make()->toArray());
            $category->gallery()->createMany(factory(\App\Models\Gallery::class, 1)->make()->toArray());
        });

        factory(\App\Models\Product::class, 400)->create()->each(function ($product) {
            $product->characteristic()->createMany(factory(\App\Models\Characteristic::class, 6)->make()->toArray());
            $product->image()->createMany(factory(\App\Models\Photo::class, 6)->make()->toArray());
        });
    }
}
