<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_envio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('calle_uno', 255);
            $table->string('calle_dos', 255);
            $table->string('direccion', 255);
            $table->string('colonia', 150);
            $table->string('municipio', 150);
            $table->string('estado', 100);
            $table->string('pais', 50);
            $table->unsignedInteger('codigo_postal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_envio');
    }
}
