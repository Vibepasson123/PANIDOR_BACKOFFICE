<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitation', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->integer('clientUser_id')->nullable();
            $table->string('invitation_num', 45)->nullable();
            $table->integer('status')->nullable();
		    $table->increments('id', 45)->nullable();
		    
	/* 	    $table->primary('id'); */
		
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
        Schema::drop('invitation');
    }
}
