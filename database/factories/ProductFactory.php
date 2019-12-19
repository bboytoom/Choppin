<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $producto = $this->faker->unique()->sentence($nbWords = 2, $variableNbWords = true);

    return [
        'admin_id' => Admin::all()->random(),
        'subcategory_id' => SubCategory::all()->random(),
        'name' => $producto,
        'slug' => Str::slug($producto, '-'),
        'extract' => $this->faker->text($maxNbChars = 50),
        'description' => $this->faker->text($maxNbChars = 250),
        'price' => $this->faker->numberBetween($min = 100, $max = 1000),
        'status' => $this->faker->numberBetween($min = 1, $max = 1)
    ];
});
