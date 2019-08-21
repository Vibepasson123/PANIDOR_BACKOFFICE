<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductMpos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_mpos', function(Blueprint $table) {
		    $table->engine = 'InnoDB';
		
		    $table->string('mpos_id', 45)->nullable();
		    $table->string('product_id', 45)->nullable();
		    $table->increments('id')->nullable();
            $table->string('codArtigo', 45)->nullable();
            $table->string('price',45)->nullable();
		
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
        Schema::drop('product_mpos');
    }
}
