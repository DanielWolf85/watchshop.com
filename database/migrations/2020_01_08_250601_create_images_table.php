<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('path')->nullable();
            $table->biginteger('product_id')->unsigned();
            $table->biginteger('color_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('color_id')->references('id')->on('colors');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
