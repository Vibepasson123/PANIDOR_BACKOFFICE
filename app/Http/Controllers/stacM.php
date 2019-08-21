<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SampleChart;
use App\Mpos;
use Carbon\Carbon;
use App\mposSale;

class stacM extends Controller
{
    public function staticstic()
    {
       
        $lat="22.804565";
        $long="86.202873";

   // $sale=Charts::database($mposSale,'area','google')->elementLabel("")->title('SALES')->template("material")->labels($mposSale->pluck('created_at'))->values($bp->pluck('product_id','quantity','MPOS_LOCATION_id'));
    
       return view ('mViews.Mstac',compact('chart','lat','long'));

    }
}
