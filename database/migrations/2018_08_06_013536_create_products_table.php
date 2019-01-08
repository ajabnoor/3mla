<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('user_id');
            $table->string('type');
            $table->integer('currency_id');
            $table->string('price_type');
            $table->integer('price')->default(0);
            $table->string('price_currency_id');
            $table->integer('profit')->default(0);
            $table->string('country_id');
            $table->string('city_id');
            $table->string('transfer_methods');
            $table->string('speed');            
            $table->integer('available');            
            $table->string('min_amount')->default(0);            
            $table->string('status')->default('pending');            
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
