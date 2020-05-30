<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40)->unique();
            $table->unsignedInteger('value');
            $table->boolean('status')->default(true);
            $table->enum('type', ['amount', 'percent'])->default('percent');
            $table->dateTime('expiration_start', 0);
            $table->dateTime('expiration_finish', 0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
