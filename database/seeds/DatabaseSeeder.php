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
        factory(\App\User::class)->create([
            'type' => 'admin',
            'name' => 'root',
            'mother_surname' => 'materno',
            'father_surname' => 'paterno',
            'email' => 'admin@correo.com',
            'email_verified_at' => now(),
            'password' => \Hash::make('@Admin2907'),
            'remember_token' => Str::random(10),
            'status' => 1
        ]);

        factory(\App\Models\Configuration::class, 1)->create()->each(function ($configuration) {
            $configuration->photoconfiguration()->createMany(factory(\App\Models\PhotoSlide::class, 4)->make()->toArray());
        });

        factory(\App\User::class, 2)->create()->each(function ($user) {
            $user->shipping()->createMany(factory(\App\Models\Shipping::class, 1)->make()->toArray());
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
        });
    }
}
