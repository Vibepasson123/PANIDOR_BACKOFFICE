<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImageFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('file_id');    
            $table->string('image_class', 3)->nullable();
            $table->boolean('selected')->nullable();
            $table->string('mpos_id', 45)->nullable();
        
            $table->string('url',    200)->nullable();
            $table->string('product_id',45)->nullable();
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
        Schema::dropIfExists('image');
    }
}
