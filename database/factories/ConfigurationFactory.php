<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Configuration;
use Faker\Generator as Faker;

$factory->define(Configuration::class, function (Faker $faker) {
    return [
        'domain' => 'www.prueba.com.mx',
        'name' => 'prueba store',
        'business_name' => 'prueba s.a. de s.v.',
        'slogan' => $this->faker->text($maxNbChars = 6),
        'logo' => 'prueba.png',
        'email' => $faker->email,
        'phone' => $faker->tollFreePhoneNumber,
        'status' => 1
    ];
});
