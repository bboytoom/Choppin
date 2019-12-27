<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(SubCategory::class, function (Faker $faker) {
    $subcategory = $this->faker->unique()->sentence($nbWords = 2, $variableNbWords = true);

    return [
        'name' => $subcategory,
        'slug' => Str::slug($subcategory),
        'description' => $this->faker->text($maxNbChars = 50),
        'status'=> 1
    ];
});
