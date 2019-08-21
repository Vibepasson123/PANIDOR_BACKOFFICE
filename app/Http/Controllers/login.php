<?php

namespace App\Http\Controllers;
use Sentinel;
use Activation;
use Mail; 
use App\User; 
use App\roles;
use Illuminate\Http\Request;

class login extends Controller
{
    public function postlogin(Request $request)
   {
     try{  
       
    if($user=Sentinel::authenticate($request->all())){

      $log=Sentinel::getUser()->id;
      
      $sug=Sentinel::getUser()->roles()->first()->slug;
   /*    $user_details = User::with('user_role')->with('user_activation')->get();
    foreach($user_details as $test)
    {
       $t =  $test->id;
         foreach($test->user_role as $newtest)
         {
            $p = $newtest->role_id;

             dd($p);

         }


    } */

        return redirect('/home');
    }else
    return redirect()->back()->with(['incrorrect'=>'check Input data']);


     }catch(ThrottlingException $e){
        $delay = $e->getDelay();

         return redirect('/')->with(['error'=>" You are band for $delay seconds"]);
         

      }catch (NotActivatedException $e){

        return redirect()->back()->with(['notactive'=>'Account Not Activated']);
        
     }


          
    }


    public function logout()
    {

     Sentinel::logout();
     return redirect('/');
    



    }
}
