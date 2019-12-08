<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
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
				'email' 	=> 'toom@correo.com', 
				'password' 	=> \Hash::make('admin123'),
				'type' 		=> 'admin',
				'status' 	=> 1,
				'created_at'=> new DateTime,
				'updated_at'=> new DateTime
			],
			[
				'name' 		=> 'niki', 
				'father_surname' => 'rosber', 
				'mother_surname' => '', 
				'email' 	=> 'niki@correo.com', 
				'password' 	=> \Hash::make('prueba123'),
				'type' 		=> 'user',
				'status' 	=> 1,
				'created_at'=> new DateTime,
				'updated_at'=> new DateTime
			],

		);

		User::insert($data);
    }
}
