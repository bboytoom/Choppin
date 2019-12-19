<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use App\Models\Product;
use App\Models\Characteristic;
use Faker\Generator as Faker;

$factory->define(Characteristic::class, function (Faker $faker) {
    return [
        'admin_id' => Admin::all()->random(),
        'product_id' => Product::all()->random(),
        'name' => $this->faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
        'description' => $this->faker->text($maxNbChars = 250),
        'status' => $this->faker->numberBetween($min = 1, $max = 1)
    ];
});
