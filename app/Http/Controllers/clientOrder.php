<?php
namespace App\Http\Controllers;
use App\orderDetails;
use Illuminate\Http\Request;

use App\Mpos;
use Sentinel;
use Activation;
use App\clientUser;
use App\User; 
use Carbon\Carbon;
use App\Mloaction;
use App\product;
use App\order;

  


class clientOrder extends Controller
{
  
  public function getOrder($id)
  {
    try{

      if($order_detail  = order::where('mpos_id','=',$id)->first()){

        if($client = clientUser::where('id','=',$order_detail->clientUser_id)->first()){

          $client_email = $client->email;

          $order= order::all();
      
          return view('orders.orderList',compact('order_detail','order','client_email'));
          
        } else

        return redirect()->back()->with(['error'=>'MPOS Empty No Order']);
      
      }else

        return redirect()->back()->with(['norder'=>'MPOS Empty No Order']);
      
      }catch(\Illuminate\Database\QueryException $e){

    }

  }
  public function CdetailOrder($oderid)
  {       

  
  $data = order::where('id','=',$oderid)->first();

  $client_id = $data->clientUser_id;

  $mpos_id = $data->mpos_id;   

  $clientdetails=clientUser::where('id','=', $client_id)->get();

  $mpos=Mpos::where('id','=',$mpos_id)->get();

  foreach($mpos as $streetmpos)
 {
    $mpos_street = Mloaction::where('id','=',$streetmpos->MPOS_LOCATION_id)->first();

    $streetmpos->streetname =   $mpos_street->streetname;
 }
    $orderD=orderDetails::where('order_id','=',$oderid)->get();

  return view('orders.orderDetails',compact('clientdetails','mpos','orderD',' mpos_street'));


  } 

}
