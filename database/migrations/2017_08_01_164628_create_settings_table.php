<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function(Blueprint $table) {
            $table->increments('id');
            $table->string('site_name', 255);
            $table->string('site_slogen', 255)->nullable();
            $table->string('site_logo', 255);
            $table->string('site_icon', 255);
            $table->string('site_status', 255)->nullable();
            $table->string('site_copyright', 255)->nullable();
            $table->string('site_playstore_link', 255)->nullable();
            $table->string('site_appstore_link', 255)->nullable();
            $table->string('site_currency', 255)->nullable();
            $table->string('site_theme_color', 255)->nullable();
            $table->string('site_google_analytics_code', 255)->nullable();
            $table->string('site_company_address', 255)->nullable();
            $table->string('site_company_phone', 255)->nullable();
            $table->string('site_email', 255)->nullable();
            $table->string('site_company_email', 255)->nullable();
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
        Schema::drop('settings');
    }
}
