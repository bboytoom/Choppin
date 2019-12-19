<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    $category = $this->faker->unique()->sentence($nbWords = 2, $variableNbWords = true);

    return [
        'admin_id' => Admin::all()->random(),
        'name' => $category,
        'slug' => Str::slug($category),
        'description' => $this->faker->text($maxNbChars = 50),
        'status'=> $this->faker->numberBetween($min = 1, $max = 1)
    ];
});
