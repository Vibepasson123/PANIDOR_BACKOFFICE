<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
            $table->increments('id');
		    $table->string('discription', 50)->nullable();
		    $table->string('name', 50)->nullable();
		    $table->string('codArtigo', 45)->nullable();
		    $table->string('vatid', 15)->nullable();
		    $table->longText('short_description')->nullable();
		    $table->string('price', 45)->nullable();
		    
		 /*    $table->primary('id'); */
		
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
        Schema::drop('product');
    }
}
