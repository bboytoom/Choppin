<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => 'root',
        'mother_surname' => $faker->lastName,
        'father_surname' => $faker->lastName,
        'email' => 'admin@gmail.com',
        'email_verified_at' => now(),
        'password' => \Hash::make('@Admin2907'),
        'remember_token' => Str::random(10),
        'status'=> 1
    ];
});
