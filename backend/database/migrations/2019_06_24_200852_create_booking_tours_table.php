<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_tours', function (Blueprint $table) {
            $table->increments('bt_id');
            $table->string('bt_num_child');
            $table->date('bt_num_adult');
            $table->integer('bt_total_price');
            $table->date('bt_date');
            $table->integer('bt_pay_status');
            $table->integer('bt_booking_status');
            $table->integer('bt_user_client');
            $table->integer('bt_tour');
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
        Schema::dropIfExists('booking_tours');
    }
}