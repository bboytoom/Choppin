<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('paypal_id');
            $table->foreign('paypal_id')
                ->references('id')->on('paypal_payments')
                ->onDelete('cascade');
            $table->unsignedInteger('shopping_cart_id');
            $table->foreign('shopping_cart_id')
                ->references('id')->on('shopping_carts')
                ->onDelete('cascade');
            $table->integer('shipping_address_id');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
