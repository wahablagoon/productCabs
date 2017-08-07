<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('role', 255)->nullable()->comment = "1=>passenger,2=>driver,3=>admin";
            $table->string('firstname', 255)->nullable();
            $table->string('lastname', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('profile', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('countrycode', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('wallet', 255)->default("0");
            $table->string('phone_verify', 255)->nullable();
            $table->string('email_verify', 255)->nullable();
            $table->string('license', 255)->nullable();
            $table->string('insurance', 255)->nullable();
            $table->string('category', 255)->nullable();
            $table->string('status', 255)->default("1");
            $table->string('online_status', 255)->default("0");
            $table->string('proof_status', 255)->default("Pending");
            $table->string('lat', 255)->nullable();
            $table->string('lang', 255)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('verifycode', 255)->nullable();
            $table->string('last_verified', 255)->nullable();
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
        Schema::drop('users');
    }
}
