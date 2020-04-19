<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->unsignedInteger('paypal_id');
            $table->foreign('paypal_id')
                ->references('id')->on('paypal_payments')
                ->onDelete('cascade');
            $table->unsignedInteger('shopping_cart_id');
            $table->foreign('shopping_cart_id')
                ->references('id')->on('shopping_carts')
                ->onDelete('cascade');
            $table->string('shipping_address', 100);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
