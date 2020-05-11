<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => 'NoCoupon',
        'value' => 0,
        'status' => true,
        'expiration' => '2050-07-29 23:59:59',
    ];
});
