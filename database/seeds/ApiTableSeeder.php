<?php

use Illuminate\Database\Seeder;

class ApiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('api')->insert([
        	['api_name' => 'firebase','code' => 'f_SECRET','value' => 'FIEkY1M4jGsJ8SyIu1unAyBPLdJvI9QgxbCpzuxG'],
			['api_name' => 'firebase','code' => 'f_UID','value' => 'firebase-adminsdk-xtjd4@productcab.iam.gserviceaccount.com'],
			['api_name' => 'firebase','code' => 'f_URL','value' => 'https://productcab.firebaseio.com/'],
			['api_name' => 'google','code' => 'GOOGLE_API_KEY','value' => 'AIzaSyDySh70ebQ8IfpzU_vqdfFAt7eni8RzIi8'],
			['api_name' => 'google','code' => 'GOOGLE_PROJECT_ID','value' => ''],
			['api_name' => 'google','code' => 'GOOGLE_CLIENT_ID','value' => ''],
			['api_name' => 'facebook','code' => 'FB_API','value' => ''],
			['api_name' => 'facebook','code' => 'FB_SECRET','value' => ''],
			['api_name' => 'twilio','code' => 'TWILIO_SID','value' => 'ACcbe5062f48b4b80892f2660ea73cf0b5'],
			['api_name' => 'twilio','code' => 'TWILIO_TOKEN','value' => 'ac08f91a02769ace9798b89ad3762ca0'],
			['api_name' => 'twilio','code' => 'TWILIO_FROM','value' => '+12679301259']
        ]);
    }
}
