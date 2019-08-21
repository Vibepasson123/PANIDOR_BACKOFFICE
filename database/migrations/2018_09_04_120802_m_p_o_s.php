<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MPOS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MPOS', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->increments('id');
		    $table->string('name', 80)->nullable();
		    $table->string('discription', 90)->nullable();
		    $table->text('OGURL')->nullable();
		    $table->string('OGapiUser', 80)->nullable();
		    $table->string('OGapipass', 45)->nullable();
		    $table->string('MPOS_LOCATION_id', 45)->nullable();
            $table->dateTime('Date_time')->nullable();
		    $table->timestamps();
		
        });
     
        Schema::create('MPOS_SALE', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		 $table->increments('id');
		    $table->string('product_id', 45)->nullable();
		    $table->string('quntity', 45)->nullable();
		    $table->string('MPOS_LOCATION_id', 45)->nullable();
		    $table->time('date_time')->nullable();
		    $table->string('og_invoice_id', 45)->nullable();
		    $table->string('price', 45)->nullable();
            $table->string('code_Artigo', 45)->nullable();
            $table->string('og_invoice_type',45)->nullable();
		
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
        Schema::drop('MPOS');
      
        Schema::drop('MPOS_SALE');

    }
}
