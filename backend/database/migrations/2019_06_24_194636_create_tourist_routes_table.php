<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTouristRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourist_routes', function (Blueprint $table) {
            $table->increments('tr_id');
            $table->string('tr_name');
            $table->integer('tr_category');
            $table->integer('tr_time');
            $table->double('tr_original_price');
            $table->integer('tr_max_slot');
            $table->string('tr_poster');
            $table->integer('tr_location');
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
        Schema::dropIfExists('tourist_routes');
    }
}