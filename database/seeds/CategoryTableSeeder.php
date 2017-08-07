<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
        	['category_name' => 'SUV','price_km' => '10','price_minute' => '10','max_size'=>'10','price_fare'=>'20','logo'=>'suv_default.png','marker'=>'marker.png'],
        	['category_name' => 'Sedan','price_km' => '10','price_minute' => '10','max_size'=>'10','price_fare'=>'20','logo'=>'sedan_default.png','marker'=>'marker.png'],
        	['category_name' => 'Hatchback','price_km' => '10','price_minute' => '10','max_size'=>'10','price_fare'=>'20','logo'=>'hatchback_default.png','marker'=>'marker.png']
        ]);
    }
}
