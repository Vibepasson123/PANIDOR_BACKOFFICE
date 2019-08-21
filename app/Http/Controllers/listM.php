<?php


namespace App\Http\Controllers;
use\App\Mpos;
use Carbon\Carbon;
use App\Mloaction;
use Illuminate\Http\Request;

class listM extends Controller
{
    public function getlist()
    {
        $mpos = Mpos::all();
     
      $MLocation= Mloaction::all();

    return view ('mViews.Mlist',compact('mpos','MLocation'));

   }

  
}




