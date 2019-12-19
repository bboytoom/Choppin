<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mother_surname' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
        'father_surname' => $this->faker->sentence($nbWords = 2, $variableNbWords = true),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => \Hash::make('prueba123'),
        'remember_token' => Str::random(10),
        'status'=> $this->faker->numberBetween($min = 1, $max = 1)
    ];
});
