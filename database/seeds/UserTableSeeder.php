<?php

use Illuminate\Database\Seeder;
use App\User;

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
				'last_name' => 'rosber', 
				'email' 	=> 'thomasrosber@gmail.com', 
				'password' 	=> \Hash::make('admin123'),
				'type' 		=> 'admin',
				'active' 	=> 1,
				'address' 	=> 'iztapalapa',
				'created_at'=> new DateTime,
				'updated_at'=> new DateTime
			],
			[
				'name' 		=> 'miguel', 
				'last_name' => 'molina', 
				'email' 	=> 'miguel@correo.com', 
				'password' 	=> \Hash::make('123456'),
				'type' 		=> 'user',
				'active' 	=> 1,
				'address' 	=> 'neza',
				'created_at'=> new DateTime,
				'updated_at'=> new DateTime
			],

		);

		User::insert($data);
    }
}
