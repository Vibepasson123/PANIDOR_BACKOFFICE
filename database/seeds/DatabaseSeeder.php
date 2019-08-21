<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call(userTable::class); 
       $this->call(typesTableSeeder::class); 
       //$this->call(user::class);  
       $this->call(roles::class); 
       $this->call(role::class);
    }
}
