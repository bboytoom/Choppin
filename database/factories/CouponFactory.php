<?php

use App\Models\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'name' => 'NoCoupon',
        'value' => 0,
        'status' => true,
        'expiration' => '2050-07-29 23:59:59',
    ];
});
