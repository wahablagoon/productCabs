<?php
use Illuminate\Database\Seeder; 
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder {

    /** 
     * Run the database seeds.
     *
     * @return void
     */
      public function run()
      {
        Eloquent::unguard();

        //call uses table seeder class
        $this->call('CountryTableSeeder');
        //this message shown in your terminal after running db:seed command
        $this->command->info("Country table seeded :)");

        $this->call('SettingsTableSeeder');
        $this->command->info("Settings table seeded :)");

        $this->call('UsersTableSeeder');
        $this->command->info("User table seeded :)");

        $this->call('CategoryTableSeeder');
        $this->command->info("Category table seeded :)");

        $this->call('ApiTableSeeder');
        $this->command->info("Api table seeded :)");
       }

}