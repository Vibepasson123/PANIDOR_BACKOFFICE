<?php

use Illuminate\Database\Seeder;

class typesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
           factory(App\types::class,1)->create()->each(function($u){
            $u->save();
           });
    }
}
