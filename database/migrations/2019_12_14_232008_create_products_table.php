<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subcategory_id');
            $table->foreign('subcategory_id')	
                ->references('id')	
                ->on('sub_categories')	
                ->onDelete('cascade');
            $table->string('name', 100)->unique();
            $table->string('slug', 150);
            $table->string('extract', 100);
            $table->text('description', 400);
            $table->decimal('price', 5, 2);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
