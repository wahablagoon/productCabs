<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
        	['site_name' => 'trippy','site_logo' => 'favicon.png','site_icon' => 'favicon.png']
        );
    }
}
