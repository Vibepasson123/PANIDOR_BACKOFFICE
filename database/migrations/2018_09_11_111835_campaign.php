<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Campaign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->increments('id');
		    $table->string('name', 45)->nullable();
		    $table->string('discription', 45)->nullable();
            $table->string('product_id', 45)->nullable();
            $table->string('price', 20)->nullable();
            $table->integer('quantity')->nullable();
            $table->string('type_id',45)->nullable();
		
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
       
		Schema::drop('campaign');
    }
}
