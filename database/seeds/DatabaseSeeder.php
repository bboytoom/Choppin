<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        factory(\App\User::class)->create([
            'type' => 'administrador',
            'name' => 'root',
            'mother_surname' => 'materno',
            'father_surname' => 'paterno',
            'email' => 'admin@correo.com',
            'email_verified_at' => now(),
            'password' => \Hash::make('@Admin2907'),
            'remember_token' => Str::random(10),
            'status' => 1
        ]);

        factory(\App\Models\Configuration::class, 1)->create()->each(function ($configuration) {
            $configuration->metaconfiguration()->createMany(factory(\App\Models\Metas::class, 1)->make()->toArray());
            $configuration->photoconfiguration()->createMany(factory(\App\Models\PhotoSlide::class, 4)->make()->toArray());
        });
    }
}
