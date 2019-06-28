<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTouristRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_tourist_routes', function (Blueprint $table) {
            $table->increments('itr_id');
            $table->string('itr_name');
            $table->integer('itr_tourist_route');
            $table->boolean('itr_highlight');
            $table->boolean('itr_default');
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
        Schema::dropIfExists('image_tourist_routes');
    }
}