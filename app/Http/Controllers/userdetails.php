<?php

namespace App\Http\Controllers;
use Sentinel;
use App\role;
use Mail; 
use App\User; 
use App\activation;
use Illuminate\Http\Request;

class userdetails extends Controller
{
    public function getall_user(Request $request)
    {

 
        $user_details = User::with('user_role')->with('user_activation')->get();


         return view('users.userDetails',compact('user_details')); 
     
    }
}
