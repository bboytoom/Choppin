<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        factory(\App\Models\Permission::class, 1)->create([
            'name' => 'root',
            'permission' => json_encode(array('root-permission'))
        ])->each(function ($permission) {
            $permission->user()->save(factory(\App\User::class)->make([
                'type' => 'administrador',
                'email' => 'admin@correo.com'
            ]));
        });

        factory(\App\Models\Permission::class, 1)->create([
            'name' => 'empaquetador',
            'permission' => json_encode(array('create-product', 'read-product', 'update-product', 'delete-product', 'detail-product'))
        ])->each(function ($permission) {
            $permission->user()->save(factory(\App\User::class)->make([
                'type' => 'staff',
                'email' => 'helps@correo.com'
            ]));
        });

        factory(\App\Models\Permission::class, 1)->create([
            'name' => 'cliente',
            'permission' => json_encode(array('whithout-permission'))
        ])->each(function ($permission) {
            $customers = $permission->user()->saveMany(factory(\App\User::class, 3)->make([
                'type' => 'cliente'
            ]));

            $customers->each(function ($user) {
                $user->shipping()->createMany(factory(\App\Models\Shipping::class, 1)->make()->toArray());
            });
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

        factory(App\Models\Coupon::class, 1)->make();
    }
}
