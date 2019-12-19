<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mother_surname' => $faker->lastName,
        'father_surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => \Hash::make('prueba123'),
        'remember_token' => Str::random(10),
        'status'=> $this->faker->numberBetween($min = 1, $max = 1)
    ];
});
