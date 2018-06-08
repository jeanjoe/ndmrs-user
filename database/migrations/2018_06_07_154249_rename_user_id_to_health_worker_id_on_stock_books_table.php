<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameUserIdToHealthWorkerIdOnStockBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_books', function( Blueprint $table) {
          $table->renameColumn('user_id', 'health_worker_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('stock_books', function( Blueprint $table) {
        $table->renameColumn('health_worker_id', 'user_id');
      });
    }
}
