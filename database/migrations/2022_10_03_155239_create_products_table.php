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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('subsubcategory_id');
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_code');
            $table->string('product_sku');
            $table->integer('product_qty');
            $table->string('product_tags');
            $table->string('product_size');
            $table->string('product_color')->nullable();
            $table->string('product_thumbnail');
            $table->string('base_price');
            $table->string('selling_price');
            $table->string('discount_price')->nullable();
            $table->text('short_description');
            $table->text('long_description');
            $table->integer('hot_deal')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deal')->nullable();
            $table->integer('status')->default(0);
            $table->integer('reviewed')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade'); //only work on unsignedBigInteger
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); //only work on unsignedBigInteger
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade'); //only work on unsignedBigInteger
            $table->foreign('subsubcategory_id')->references('id')->on('sub_sub_categories')->onDelete('cascade'); //only work on unsignedBigInteger
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
        Schema::dropIfExists('products');
    }
};
