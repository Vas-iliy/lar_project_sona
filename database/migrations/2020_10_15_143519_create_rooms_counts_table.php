<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_counts', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('room_id')->unsigned()->nullable();
            $table->foreign('room_id')->references('id')->on('rooms');

            $table->bigInteger('count_id')->unsigned()->nullable();
            $table->foreign('count_id')->references('id')->on('counts');

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
        Schema::dropIfExists('rooms_counts');
    }
}
