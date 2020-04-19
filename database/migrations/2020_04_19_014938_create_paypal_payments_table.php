<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaypalPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('paypal_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payment_id', 40);
            $table->string('payer_id', 40);
            $table->string('token', 40);
            $table->string('state', 20);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('paypal_payments');
    }
}
