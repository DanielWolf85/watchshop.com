<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('product_name');
            $table->biginteger('category_id')->unsigned();
            $table->biginteger('brand_id')->unsigned();
            $table->float('price')->nullable();
            $table->biginteger('color_id')->unsigned();
            $table->biginteger('size_id')->unsigned();
            $table->string('description')->nullable();
            $table->text('content_raw');
            $table->text('content_html');
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();


            $table->timestamps();
            $table->softDeletes();


            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->index('is_published');
        });


            
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
