<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('name', 100);
            $table->string('street_one', 100);
            $table->string('street_two', 100)->nullable();
            $table->string('addres', 200);
            $table->string('suburb', 80);
            $table->string('town', 80);
            $table->string('state', 40);
            $table->string('country', 20);
            $table->string('postal_code', 7);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shippings');
    }
}
