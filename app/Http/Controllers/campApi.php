<?php

namespace App\Http\Controllers;
use \App\Mpos;
use Sentinel;
use GuzzleHttp\Client;
use Activation;
use \App\clientUser;
use \App\User; 
use \App\mposSale;
use Validator;
use Carbon\Carbon;
use \App\Mlocation;
use \App\product;
use \App\order;
use \App\invitation ;
use\App\product_limit;
use \App\og_client;
use\App\MposCamp;
use App\Camp;
use\App\orderDetails;
use\App\voucher;
use Illuminate\Http\Request;

class campApi extends Controller
{
    public function getCampaing(Request $request)
    { 
        
            $email = $request->input('email');
            $hash = $request->input('hash');
            $mmpos =$request->input('mpos');
            if( $user= clientUser::where('email','=',$email)->where('hash','=',$hash)->first())
            {
                $activeCamp = Camp::whereHas('camp_mpos',function ($query) { $query->where('status','=', 1);})->get(); 
              

              
                    return response()->json( ['result'=>['success'=>true,],'data'=>$activeCamp]);
               
              
              

            }   
            else
            {
                return response()->json( ['result'=>['success'=>false,],'data'=>"USER NOT AUTHORIZED"]);
            }

    }
}
