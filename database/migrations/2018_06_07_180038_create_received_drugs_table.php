<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivedDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_drugs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('drug_id');
            $table->unsignedInteger('stock_book_id');
            $table->integer('quantity')->default(0);
            $table->string('organization');
            $table->date('receive_date');
            $table->date('manufacture_date');
            $table->date('expiry_date');
            $table->string('batch_number');
            $table->string('voucher_number');
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
        Schema::dropIfExists('received_drugs');
    }
}
