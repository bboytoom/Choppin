<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoSlidesTable extends Migration
{
    public function up()
    {
        Schema::create('photo_slides', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('configuration_id');
            $table->foreign('configuration_id')
                ->references('id')->on('configurations')
                ->onDelete('cascade');
            $table->string('name', 100)->unique();
            $table->string('image', 50);
            $table->text('description');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('photo_slides');
    }
}
