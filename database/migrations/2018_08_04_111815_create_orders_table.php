<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('owner_id');
            $table->integer('buyer_id');
            $table->integer('product_id');
            $table->decimal('ordered_amount',5,2)->default(0);
            $table->integer('status_id');            
            $table->integer('owner_notifications')->default(0);            
            $table->integer('buyer_notifications')->default(0);            
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
