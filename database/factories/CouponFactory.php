<?php

use App\Models\Coupon;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'name' => 'NoCoupon',
        'value' => 0,
        'type' => 'percent',
        'status' => true,
        'expiration_start' => '2020-01-01 00:00:00',
        'expiration_finish' => '2050-07-29 23:59:59',
    ];
});
