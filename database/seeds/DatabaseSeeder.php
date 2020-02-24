<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'type' => 'administrador',
            'name' => 'root',
            'mother_surname' => 'materno',
            'father_surname' => 'paterno',
            'email' => 'admin@correo.com',
            'email_verified_at' => now(),
            'password' => '@Admin2907',
            'remember_token' => Str::random(10),
            'status' => 1
        ]);
    }
}
