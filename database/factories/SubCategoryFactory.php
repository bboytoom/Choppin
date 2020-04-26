<?php

use App\Models\SubCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(SubCategory::class, function (Faker $faker) {
    $subcategory = $this->faker->unique()->sentence($nbWords = 1, $variableNbWords = true);

    return [
        'name' => $subcategory,
        'slug' => Str::slug($subcategory),
        'description' => $this->faker->text($maxNbChars = 10),
        'status'=> 1
    ];
});
