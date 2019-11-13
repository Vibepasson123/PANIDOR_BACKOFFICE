<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class DisplaytStat extends Controller
{
    public function mothleysale()
    {

        $lat="39.7572630";
        $long="-8.7893010";
       
     return view('mViews.Mstac',compact('sale','lat','long') );

    }
}
