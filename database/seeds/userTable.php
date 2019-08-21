<?php

use Illuminate\Database\Seeder;

class userTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
        //'username' => 'admin',
        'first_name' => 'admin',
        'last_name' => 'admin',
        'email' => 'admin@realnata.pt',
        'password' => bcrypt('admin'),
        //'role' => 'user'
      ]);/*
        DB::table('users')->insert([
            'first_name' => 'admin',
            'email' => 'admin@realnata.pt',
            'password' => bcrypt('admin'),
        ]);
        DB::table('users')->insert([
            'first_name' => 'geral',
            'email' => 'geral@realnata.pt',
            'password' => bcrypt('geral'),
        ]);
        DB::table('users')->insert([
            'first_name' => 'master',
            'email' => 'master@realnata.pt',
            'password' => bcrypt('master'),
            'permissions'=>'1',
        ]);*/
    }
}
