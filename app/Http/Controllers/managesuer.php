<?php

namespace App\Http\Controllers;
use Sentinel;
use Activation;
use Mail; 
use App\User; 
use App\role;
use Illuminate\Http\Request;

class managesuer extends Controller
{
    public function createuser(Request $request)
    {
       
     try{
         $newRole = role::where('slug','=',$request->input('role'))->first();
           if($newRole == NULL)   
           {
               $createRole = new role;
               $createRole->name = $request->input('role');
               $createRole->slug= $request->input('role');
               $createRole->save();
           }


        if($user=Sentinel::registerAndActivate($request->all())){
          
          $activation =Activation::create($user);
          $role=Sentinel::findRoleBySlug($request->input('role'));
          $role->users()->attach($user); 
         
          return redirect('/');
        }else{

            return redirect()->back()->with(['error'=> 'Sorry Please try again...!!! Something went wrong ?']);
        }

     }
     catch(\Illuminate\Database\QueryException $e){

        return redirect()->back()->with(['error'=>'Sorry Account Already Exsist']);
     }

    }
}
