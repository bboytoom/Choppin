<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domain', 80)->unique();
            $table->string('name', 100)->unique();
            $table->string('business_name', 150);
            $table->text('slogan', 255)->nullable();
            $table->string('logo', 50)->nullable();
            $table->string('email', 70)->unique();
            $table->string('phone', 15)->unique();
            $table->decimal('cost_shipping', 5, 2)->default(0.0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
