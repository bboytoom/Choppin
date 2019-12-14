<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')	
                ->references('id')	
                ->on('admins')	
                ->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')	
                ->references('id')	
                ->on('categories')	
                ->onDelete('cascade');
            $table->string('name', 255)->unique();
            $table->string('slug', 150);	
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
        Schema::dropIfExists('sub_categories');
    }
}
