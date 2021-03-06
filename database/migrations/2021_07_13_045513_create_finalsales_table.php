<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalsalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finalsales', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->string('name');
            $table->integer('price')->nullable();
            $table->integer('quantity');
            $table->integer('total');
            $table->integer('total_for_services')->nullable();
            $table->integer('profit');
            $table->integer('phone')->nullable();
            $table->integer('profit_of_services')->nullable();
            $table->string('payment_method')->nullable();
            $table->integer('user_id')->nullable();
            $table->mediumText('image')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('finalsales');
    }
}
