<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToAvailabilityPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('availability_prices', function($table) {
      $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('availability_prices', function($table) {
      $table->dropForeign('availability_prices_room_id_foreign');
      });
    }
}
