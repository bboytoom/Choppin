<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        factory(\App\User::class)->create([
            'type' => 'administrador',
            'email' => 'admin@correo.com'
        ]);

        factory(\App\User::class)->create([
            'type' => 'staff',
            'email' => 'staff@correo.com'
        ]);

        factory(\App\User::class, 3)->create([
            'type' => 'cliente'
        ])->each(function ($user) {	
            $user->shipping()->createMany(factory(\App\Models\Shipping::class, 1)->make()->toArray());	
        });

        factory(\App\Models\Configuration::class, 1)->create()->each(function ($configuration) {
            $configuration->metaconfiguration()->createMany(factory(\App\Models\Metas::class, 1)->make()->toArray());
            $configuration->photoconfiguration()->createMany(factory(\App\Models\PhotoSlide::class, 4)->make()->toArray());
        });

        factory(\App\Models\Category::class, 3)->create()->each(function ($category) {	
            $subcategoria = $category->subcategory()->saveMany(factory(\App\Models\SubCategory::class, 5)->make());	
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
