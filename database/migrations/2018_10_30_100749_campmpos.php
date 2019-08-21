<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Campmpos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camp_mpos', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('mpos_id')->nullable();
            $table->integer('product_id')->nullable();
		    $table->integer('camp_id')->nullable();
		    $table->string('ogCampaign_product_id', 45)->nullable();
		    $table->string('start_date', 45)->nullable();
            $table->string('end_date', 45)->nullable();
            $table->integer('status')->nullable();
            $table->string('camp_mpos_name', 45)->nullable();
            $table->string('quantity',45)->nullable();
		
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
        Schema::drop('camp_mpos');
    }
}
