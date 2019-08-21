<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Mposlocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MPOS_LOCATION', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->increments('id')->nullable();
		    $table->string('latitude', 45)->nullable();
		    $table->string('longitude', 45)->nullable();
		    $table->string('postalcode', 45)->nullable();
		    $table->string('mpos_id', 25)->nullable();
		    $table->time('date_time')->nullable();
		    $table->string('streetname', 200)->nullable();
		    $table->string('employee', 45)->nullable();
		    $table->integer('active')->nullable();
		
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
        Schema::drop('MPOS_LOCATION');
    }
}
