<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
			[
				'name' 		=> 'tomas', 
				'father_surname' => 'paterno', 
				'mother_surname' => 'materno', 
				'email' 	=> 'toom@gcorreo.com', 
				'password' 	=> \Hash::make('admin123'),
				'type' 		=> 'admin',
				'active' 	=> 1,
				'created_at'=> new DateTime,
				'updated_at'=> new DateTime
			],
			[
				'name' 		=> 'miguel', 
				'father_surname' => 'molina', 
				'mother_surname' => 'alfaro', 
				'email' 	=> 'miguel@correo.com', 
				'password' 	=> \Hash::make('123456'),
				'type' 		=> 'user',
				'active' 	=> 1,
				'created_at'=> new DateTime,
				'updated_at'=> new DateTime
			],

		);

		User::insert($data);
    }
}
