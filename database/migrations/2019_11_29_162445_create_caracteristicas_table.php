<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracteristicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_caracteristicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('caracteristica', 50);
            $table->text('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('productos_caracteristicas');
    }
}
