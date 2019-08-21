<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->increments('id');
		    $table->integer('clientUser_id')->nullable();
		    $table->string('product_id', 55)->nullable();
		    $table->integer('quantity')->nullable();
            $table->dateTime('pickupTime')->nullable();
            $table->string('og_order_id', 45)->nullable();
            $table->string('total_price', 45)->nullable();
		    $table->integer('mpos_id')->nullable();
		
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
        Schema::drop('order');
    }
}
