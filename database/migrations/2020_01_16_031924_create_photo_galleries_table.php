<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoGalleriesTable extends Migration
{
    public function up()
    {
        Schema::create('photo_galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')	
                ->references('id')->on('categories')	
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
        Schema::dropIfExists('photo_galleries');
    }
}
