<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_slides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('configuration_id');
            $table->foreign('configuration_id')
                ->references('id')->on('configurations')
                ->onDelete('cascade');
            $table->string('name', 255)->unique();
            $table->string('image', 100);
            $table->text('description');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_slides');
    }
}
