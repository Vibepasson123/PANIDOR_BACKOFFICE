<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Sentinel;
/* use Activation; */
use Mail; 
use App\User; 
class registerUser extends Controller
{
    public function checkUser()
    {
       $Newusers= User::all(); 



        return view ('users.login',compact('Newusers'));
    }

    public function authenticateUserRegister()
    {


        $Newusers= User::all();
       if(count($Newusers)==0)
       {
        return view('users.Register',compact('Newusers')); 

       }
       else{
        if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug =='master'){
           
            return view('users.Register',compact('Newusers')); 
       }else
    

       
       return redirect('/home');
  
        
    }

 
    }

}
