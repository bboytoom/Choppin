<?php

use Illuminate\Database\Seeder;
use App\Caracteristica;

class UsersCaracteristicasSeeder extends Seeder
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
				'producto_id' => 1, 
				'caracteristica' => 'caracteristica uno',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
			],
			[
				'producto_id' => 1, 
				'caracteristica' => 'caracteristica dos',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
			],
            [
				'producto_id' => 2, 
				'caracteristica' => 'caracteristica uno',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
			],
			[
				'producto_id' => 2, 
				'caracteristica' => 'caracteristica dos',
                'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'
			]
		);

		Caracteristica::insert($data);
    }
}
