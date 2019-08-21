<?php

use Illuminate\Database\Seeder;

class role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\role::class,1)->create()->each(function($u){
            $u->save();
           });
    }
}
