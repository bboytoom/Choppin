<?php

use App\Models\Shipping;
use Faker\Generator as Faker;

$factory->define(Shipping::class, function (Faker $faker) {
    return [
        'name' => 'home',
        'street_one' => $faker->streetAddress,
        'street_two' => $faker->streetAddress,
        'addres' => $faker->address,
        'suburb' => $faker->citySuffix,
        'town' => $faker->city,
        'state' => $faker->state,
        'country_code' => 'MX',
        'postal_code' => $faker->numerify('0####'),
        'status' => 1
    ];
});
