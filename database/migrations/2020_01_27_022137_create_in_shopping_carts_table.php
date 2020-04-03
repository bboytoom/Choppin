<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInShoppingCartsTable extends Migration
{
    public function up()
    {
        Schema::create('in_shopping_carts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shopping_cart_id');
            $table->foreign('shopping_cart_id')
                ->references('id')->on('shopping_carts')
                ->onDelete('cascade');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');
            $table->integer('qty')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('in_shopping_carts');
    }
}
