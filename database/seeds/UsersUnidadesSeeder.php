<?php

use Illuminate\Database\Seeder;
use App\Unidades;

class UsersUnidadesSeeder extends Seeder
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
				'unidad' => 'Pieza', 
				'contraccion' => 'Pza'
			],
			[
				'unidad' => 'Kilo', 
				'contraccion' => 'K'
			]
		);

		Unidades::insert($data);
    }
}
