<?php

use App\Models\Configuration;
use Faker\Generator as Faker;

$factory->define(Configuration::class, function (Faker $faker) {
    return [
        'domain' => 'www.prueba.com.mx',
        'name' => 'prueba store',
        'business_name' => 'prueba s.a. de s.v.',
        'slogan' => $this->faker->text($maxNbChars = 6),
        'logo' => '20200110000446_logo_default.png',
        'email' => $faker->email,
        'phone' => $faker->tollFreePhoneNumber,
        'cost_shipping' => 100.00,
        'status' => 1
    ];
});
