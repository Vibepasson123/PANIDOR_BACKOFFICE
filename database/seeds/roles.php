<?php

use Illuminate\Database\Seeder;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\roles::class,1)->create()->each(function($u){
            $u->save();
           });
    }
}
