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
        	['category_name' => 'SUV','price_km' => '10','price_minute' => '10','max_size'=>'10','price_fare'=>'20','logo'=>'SUV-512.png','marker'=>'SUV-512.png'],
        	['category_name' => 'Sedan','price_km' => '10','price_minute' => '10','max_size'=>'10','price_fare'=>'20','logo'=>'vehicle-icon-png-car-sedan-4.png','marker'=>'vehicle-icon-png-car-sedan-4.png'],
        	['category_name' => 'Hatchback','price_km' => '10','price_minute' => '10','max_size'=>'10','price_fare'=>'20','logo'=>'hatchback-512.png','marker'=>'hatchback-512.png']
        ]);
    }
}
