<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
        'image' => '20200111034735_producto_default.png',
        'description' => $this->faker->text($maxNbChars = 250),
        'status' => 1
    ];
});
