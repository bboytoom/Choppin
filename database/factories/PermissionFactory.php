<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Permission;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    $name = $faker->unique()->word;
   
    return [
        'name' => $name,
        'permission' => json_encode(array(Str::slug($name, '-'))),
        'status' => true
    ];
});
