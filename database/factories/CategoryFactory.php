<?php

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    $category = $this->faker->unique()->sentence($nbWords = 1, $variableNbWords = true);

    return [
        'name' => $category,
        'slug' => Str::slug($category),
        'description' => $this->faker->text($maxNbChars = 50),
        'status'=> 1
    ];
});
