<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingPassengerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_passenger', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('booking_id')->references('id')->on('bookings');
            $table->Integer('passenger_id')->references('id')->on('passengers');
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
        //$table->dropForeign('booking_id_foreign');
        //$table->dropForeign('passenger_id_foreign');
        Schema::dropIfExists('booking_passenger');
    }
}
