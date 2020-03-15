<?php

use App\Models\Characteristic;
use Faker\Generator as Faker;

$factory->define(Characteristic::class, function (Faker $faker) {
    return [
        'name' => $this->faker->unique()->sentence($nbWords = 2, $variableNbWords = true),
        'description' => $this->faker->text($maxNbChars = 250),
        'status' => 1
    ];
});
