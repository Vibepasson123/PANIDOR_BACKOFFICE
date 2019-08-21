<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Clientuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientUser', function(Blueprint $table) {
        $table->engine = 'InnoDB';
         
        $table->increments('id');
        $table->string('email', 200)->nullable();
        $table->string('hash', 100)->nullable();
        $table->string('password', 255);
        $table->string('first_name', 85)->nullable();
        $table->string('last_name', 85)->nullable();
        $table->string('mobile', 45)->nullable();
        $table->string('address', 45)->nullable();
        $table->string('tax_id', 45)->nullable();
        $table->string('zipcode', 45)->nullable();
        $table->string('country', 45)->nullable();
        $table->string('city', 45)->nullable();
        $table->string('fb_userid')->nullable();
    
		
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
        Schema::drop('clientUser');
    }
}
