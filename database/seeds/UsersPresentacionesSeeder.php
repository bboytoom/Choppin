<?php

use Illuminate\Database\Seeder;
use App\Presentaciones;

class UsersPresentacionesSeeder extends Seeder
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
				'presentacion' => 'Pieza', 
				'contraccion' => 'Pza'
			],
			[
				'presentacion' => 'Caja', 
				'contraccion' => 'Cja'
			]
		);

		Presentaciones::insert($data);
    }
}
