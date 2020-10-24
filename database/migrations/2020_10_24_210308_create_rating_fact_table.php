<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingFactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_fact', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rating_id')->unsigned()->nullable();
            $table->foreign('rating_id')->references('id')->on('ratings');

            $table->bigInteger('fact_id')->unsigned()->nullable();
            $table->foreign('fact_id')->references('id')->on('facts');
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
        Schema::dropIfExists('rating_fact');
    }
}
