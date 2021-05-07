<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('product_name');
            $table->string('product_barcode');
            $table->integer('buying_price');
            $table->integer('selling_price');
            $table->integer('quantity_of_pack')->nullable();
            $table->integer('number_of_pack')->nullable();
            $table->integer('product_quantity')->nullable();
            $table->mediumText('product_image')->nullable();
            $table->string('product_desc')->nullable();
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
}
