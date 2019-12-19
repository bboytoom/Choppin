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
        factory(\App\Admin::class, 2)->create();
        factory(\App\User::class, 5)->create();
        factory(\App\Models\Shipping::class, 10)->create();
        factory(\App\Models\Category::class, 20)->create();
        factory(\App\Models\SubCategory::class, 40)->create();
        factory(\App\Models\Product::class, 150)->create();
        factory(\App\Models\Characteristic::class, 400)->create();
    }
}
