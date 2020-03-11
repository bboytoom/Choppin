<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetasTable extends Migration
{
    public function up()
    {
        Schema::create('metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('configuration_id');
            $table->foreign('configuration_id')
                ->references('id')->on('configurations')
                ->onDelete('cascade');
            $table->text('keyword');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('metas');
    }
}
