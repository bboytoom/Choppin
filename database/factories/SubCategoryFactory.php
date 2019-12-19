<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(SubCategory::class, function (Faker $faker) {
    $subcategory = $this->faker->unique()->sentence($nbWords = 2, $variableNbWords = true);

    return [
        'admin_id' => Admin::all()->random(),
        'category_id' => Category::all()->random(),
        'name' => $subcategory,
        'slug' => Str::slug($subcategory),
        'description' => $this->faker->text($maxNbChars = 50),
        'status'=> $this->faker->numberBetween($min = 1, $max = 1)
    ];
});
