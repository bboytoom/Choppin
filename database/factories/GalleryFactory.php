<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gallery;
use Faker\Generator as Faker;

$factory->define(Gallery::class, function (Faker $faker) {
    $gallery = $this->faker->unique()->sentence($nbWords = 2, $variableNbWords = true);

    return [
        'name' => $gallery,
        'active'=> 1,
        'status'=> 1
    ];
});
