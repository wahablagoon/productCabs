<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeakHourPricingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peak_hour_pricing', function(Blueprint $table) {
            $table->increments('id');
            $table->string('start_time', 255);
            $table->string('end_time', 255);
            $table->string('days', 255);
            $table->string('category', 255);
            $table->string('type', 255);
            $table->string('amount', 255);
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
        Schema::drop('peak_hour_pricing');
    }
}
