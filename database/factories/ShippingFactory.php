<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\Shipping;
use Faker\Generator as Faker;

$factory->define(Shipping::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random(),
        'street_one' => $faker->streetAddress,
        'street_two' => $faker->streetAddress,
        'addres' => $faker->address,
        'suburb' => $faker->citySuffix,
        'town' => $faker->city,
        'state' => $faker->state,
        'country' => 'mexico',
        'postal_code' => $faker->numerify('0 ####'),
        'status' => $this->faker->numberBetween($min = 1, $max = 1)
    ];
});
