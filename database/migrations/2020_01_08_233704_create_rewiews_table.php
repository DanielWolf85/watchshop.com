<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewiewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewiews', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->biginteger('product_id')->unsigned();
            $table->biginteger('user_id')->unsigned();
            $table->string('content')->nullable();

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('rewiews');
    }
}
