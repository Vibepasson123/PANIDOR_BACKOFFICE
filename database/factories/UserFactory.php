<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

 $factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' =>'master' ,
        'email' => 'master@realnata.pt',
        'password' =>  bcrypt('master'), // secret
    
    ];
    return [
        'first_name' =>'admin' ,
        'email' => 'admin@realnata.pt',
        'password' =>  bcrypt('admin'), // secret
    
    ];

}); 


$factory->define(App\role::class,function(Faker $faker){
return[
'slug'=>'master',
'name'=>'master',

];
 return[
    'slug'=>'admin',
    'name'=>'admin',

];

return[
    'slug'=>'client',
    'name'=>'client'
]; 

});


$factory->define(App\roles::class,function($faker){
return[
'user_id'=>1,
'role_id'=>1,
];
return[
    'user_id'=>2,
    'role_id'=>2
]; 


}); 


$factory->define(App\types::class,function(Faker $faker){

    return [
        'description'=>'launching_campaing',
    ];
}); 
