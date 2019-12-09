<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
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
				'name' => 'toom', 
				'father_surname' => 'rosber', 
				'mother_surname' => '', 
				'email' => 'toom@correo.com', 
				'password' => \Hash::make('admin123'),
				'status' => 1,
				'created_at'=> new DateTime,
				'updated_at'=> new DateTime
			],

		);

		Admin::insert($data);
    }
}
