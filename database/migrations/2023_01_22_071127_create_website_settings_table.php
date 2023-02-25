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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('icon'); 
            $table->string('logo'); 
            $table->string('phone'); 
            $table->string('email'); 
            $table->string('company_name'); 
            $table->string('company_slogan')->nullable(); 
            $table->string('company_address'); 
            $table->text('scroll_ads')->nullable(); 
            $table->string('facebook')->nullable(); 
            $table->string('instagram')->nullable(); 
            $table->string('twitter')->nullable(); 
            $table->string('linkedin')->nullable(); 
            $table->string('youtube')->nullable(); 
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
        Schema::dropIfExists('website_settings');
    }
};
