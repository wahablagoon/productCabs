<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentation', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('provider_id');
            $table->string('service_name', 255);
            $table->string('service_number', 255);
            $table->string('service_model', 255);
            $table->string('provider_status', 255);
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
        Schema::drop('documentation');
    }
}
