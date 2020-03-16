<?php

use App\Models\Metas;
use Faker\Generator as Faker;

$factory->define(Metas::class, function (Faker $faker) {
    return [
        'keyword' => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'description' => $faker->text($maxNbChars = 100)
    ];
});
