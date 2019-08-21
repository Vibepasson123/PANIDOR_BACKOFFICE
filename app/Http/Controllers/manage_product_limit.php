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
use\App\orderDetails;
use\App\voucher;
use Illuminate\Http\Request;

class manage_product_limit extends Controller
{
      public function Mpos_product_limit($id)
      {
   

        $mpos_product = product::whereHas('productmpos',function ($query) use($id){ $query->where('mpos_id','=', $id);})->get(); 
    
        $product_limit=[];
        foreach($mpos_product as $new_mpos_product)
        {
              
         $product_limit[] =product_limit::where('mpos_id','=',$id)->where('product_id','=',$new_mpos_product->id)->get(); 

           $new_mpos_product->limit = $product_limit;

        }
      
  
    
        return view('products.product_limit',compact('mpos_product'));
      }
}
