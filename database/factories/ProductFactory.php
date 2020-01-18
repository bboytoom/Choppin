<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $producto = $this->faker->unique()->sentence($nbWords = 2, $variableNbWords = true);

    return [
        'name' => $producto,
        'slug' => Str::slug($producto, '-'),
        'extract' => $this->faker->text($maxNbChars = 50),
        'description' => $this->faker->text($maxNbChars = 250),
        'price' => $this->faker->numerify('###'),
        'status' => 1
    ];
});
