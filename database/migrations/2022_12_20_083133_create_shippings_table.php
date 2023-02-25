<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('pincode_id');
            $table->unsignedBigInteger('user_id');
            $table->string('shipping_name');
            $table->string('shipping_email');
            $table->integer('shipping_phone');
            $table->string('shipping_address');
            $table->text('notes')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade'); //only work on unsignedBigInteger
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade'); //only work on unsignedBigInteger
            $table->foreign('pincode_id')->references('id')->on('postal_codes')->onDelete('cascade'); //only work on unsignedBigInteger
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
        Schema::dropIfExists('shippings');
    }
};
