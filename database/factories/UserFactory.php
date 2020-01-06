<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mother_surname' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
        'father_surname' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => \Hash::make('@User2907'),
        'remember_token' => Str::random(10),
        'status'=> 1
    ];
});
