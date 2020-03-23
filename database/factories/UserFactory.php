<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'type' => 'cliente',
        'name' => $faker->name,
        'mother_surname' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
        'father_surname' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => \Hash::make('@Prueba2907'),
        'remember_token' => Str::random(10),
        'status'=> 1
    ];
});
