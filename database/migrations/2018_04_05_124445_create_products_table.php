<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
          $table->increments('id');
          $table->integer('stock_id')->unsigned();
          $table->string('product_name', 200);
          $table->string('from');
          $table->date('transDate');
          $table->integer('quantity');
          $table->string('voucher');
          $table->string('batch_no');
          $table->date('expiry_date');
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
        Schema::dropIfExists('products');
    }
}
