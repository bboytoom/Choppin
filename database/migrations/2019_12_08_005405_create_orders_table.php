<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("shopping_cart_id");
            $table->foreign("shopping_cart_id")->references("id")->on("shopping_carts")->onDelete('cascade');
            $table->string('guide_numer')->nullable(true);
            $table->decimal('total', 5, 2);
            $table->string('status', 20)->default('creado');
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
        Schema::dropIfExists('orders');
    }
}
