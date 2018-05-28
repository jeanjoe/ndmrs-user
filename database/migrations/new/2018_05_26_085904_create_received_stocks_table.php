<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivedStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('health_facility_id');
            $table->foreign('health_facility_id')->references('id')->on('health_facilities');
            $table->unsignedInteger('health_worker_id');
            $table->foreign('health_worker_id')->references('id')->on('health_workers');
            $table->date('receive_date');
            $table->string('given_by')->nullable();
            $table->string('voucher_number')->nullable();
            $table->string('batch_number')->nullable();
            $table->integer('quantity')->default(0);
            $table->date('manufacture_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('received_stocks');
    }
}
