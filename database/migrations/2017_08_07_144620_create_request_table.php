<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function(Blueprint $table) {
            $table->increments('id');
            $table->string('pickup', 255)->nullable();
            $table->string('destination', 255)->nullable();
            $table->string('payment_mode', 255)->nullable();
            $table->string('passenger_id', 255)->nullable();
            $table->string('driver_id', 255)->nullable();
            $table->string('category', 255)->nullable();
            $table->string('pickup_address', 255)->nullable();
            $table->string('drop_address', 255)->nullable();
            $table->string('request_type', 255)->nullable();
            $table->string('trip_id', 255)->nullable();
            $table->string('ride_type', 255)->nullable();
            $table->string('request_status', 255)->default("processing");
            $table->string('eta', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->string('c_id', 255)->nullable();
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
        Schema::drop('request');
    }
}
