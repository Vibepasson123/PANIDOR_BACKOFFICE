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
use\App\product_limit;
use \App\invitation ;
use \App\og_client;
use \App\Camp;
use \App\MposCamp;
use\App\orderDetails;
use\App\voucher;

use Illuminate\Http\Request;

class orderApi extends Controller
{


  public function checkUser($email,$hash) {
    return clientUser::where('email','=',$email)
          ->where('hash','=',$hash)
          ->first();
  }

  public function Clientorder(Request $request)
  {
    if (!$data=$request->json()->all()) 
    {
      return response()->json(['error'=>'Request is empty!','code'=>406]);
    }
    $email      = $data['email'];
    $hash       = $data['hash'];
    $mpos       = $data['mpos_id'];
    $pick_time  = $data['pickTime']; 
    $user = $this->checkUser($email,$hash);
    if ($user)
    {
      if(!$mpos=MPOS::where('id','=',$mpos)->first())
      {
        return response()->json(['error'=>'Mpos not found','code'=>404]);
      }
      $country= $this->getCountries($mpos);
      $client = new Client();
      $url = $mpos->OGURL;
      if (!empty($url) && strlen($url)>0 && $url[(strlen($url)-1)]=='/')
      {
        $url = substr($url, 0, (strlen($url)-1));
      }

      if (!$og_client=og_client::where('client_id','=',$user->id)->first())
      {
        $res_client = $this->callOGApi($client, 'POST', $url.'/api/entities/customers', $mpos->OGapiUser, $mpos->OGapipass, [
            'name'            =>  $user->first_name,
            'address'         =>  $user->address,
            'city'            =>  $user->city,
            'zipcode'         =>  $user->zipcode,
            'country'         =>  $country,
            'customertaxid'   =>  $user->tax_id
        ]);
        if ($res_client['status']==200) 
        {
          $res = json_decode($res_client['body']);
          if ($res->code==1000) 
          {
            $og = new og_client;
            $og->client_id = $user->id; 
            $og->mpos_id = $mpos->id;
            $og->og_client_id = $res->customer_id;
            $og->save();
            $og_client = $og;
          }
          else 
          {
            return response()->json(['error'=>'Fail creating client','code'=>$res->code]);
          }
        }
        else 
        {
          return response()->json(['error'=>'Connection failed ','code'=>204]);
        }
      }
      
      if (empty($data['products']) || !is_array($data['products']) || count($data['products'])<=0)
      {
        return response()->json(['error'=>'products is empty!','code'=>406]);
      }
      
      $produtos_desc_task = "";
      $vouchers = [];
      foreach($data['products'] as $item)
      {
        if (array_key_exists("offer", $item['item']) && $item['item']["offer"]>0) {
          $vouchers[$item['item']["id"]] = $item['item']["offer"];
        }
        $lines[] = [
          "idarticle"     =>  $item['item']['codArtigo'],
          "quantity"      =>  $item['item']['qty'],
          "sellingprice"  =>  $this->calcVATPrice($item['item']['price'], $item['item']['vatid']),
        ];
        $produtos_desc_task .= "&#09;[".$item["item"]["codArtigo"]."] ".$item["item"]["name"]." quantidate: ".$item["item"]["qty"]."<br>";
      }

      $res_order = $this->callOGApi($client, 'POST', $url.'/api/sales/documents/'.env("OG_API_DOCUMENT_TYPE","ENC"), $mpos->OGapiUser, $mpos->OGapipass, [
        'idcustomer'  =>  $og_client->og_client_id,
        'lines'       =>  $lines,
      ]);
      if ($res_order['status']==200) 
      {
        $res = json_decode($res_order['body']);
        if ($res->code==1000) 
        {
          $order = new order();
          $order->clientuser_id   = $user->id;
          $order->pickuptime      = $pick_time;
          $order->mpos_id         = $mpos->id;
          $order->og_order_id     = $res->document_number;
          $order->total_price     = $res->document->total;
          $order->save();

          foreach($res->lines as $line)

          {

            
            $order_line = new orderDetails;
            $product = product::where('codArtigo','=',$line->idarticle)->first();

            if (empty($product))
            {
              $this->rollbackOrder($order->id);
              return response()->json(['error'=>'product not found','code'=>'404']);
            }

            $order_line->product_id   = $product->id;
            $order_line->price        = $line->sellingprice;
            $order_line->quantity     = $line->quantity;
            $order_line->vatid        = $line->vat;
            $order_line->order_id     = $order->id;
            $order_line->save();

            if ($order_line->price===0 && array_key_exists($order_line->product_id, $vouchers)) 
            {
              voucher::where('id', $vouchers[$order_line->product_id])->update(['orderline_id' => $order_line->id]);  
            }
          }
            $this->callOGApi($client, 'POST', $url.'/api/crm/tasks/', $mpos->OGapiUser, $mpos->OGapipass, [
            'description'  =>  "Nova Encomenda ",
            'date'       =>  $pick_time,
            'adicionaldescription' => "Encomenda: ".$res->document->documentnumber."<br>Produtos:<br>".$produtos_desc_task,
            'task'=>'T',
            'priority'=>'H'
          ]);
        }
        else 
        {
          return response()->json(['error'=>'Fail creating order','code'=>$res->code]);
        }
      }
      else 
      {
        return response()->json(['error'=>'Connection failed','code'=>204]);
      }
      return response()->json(['success'=>'Order place succefully!','code'=>200]);
    }
    return response()->json(['error'=>'unauthorised user','code'=>401]);
  }

	
  public function ClientOrderMin(Request $request)
  {
    if (!$data=$request->json()->all()) 
    {
      return response()->json(['error'=>'Request is empty!','code'=>406]);
    }
    $email      = $data['email'];
    $hash       = $data['hash'];
    $mpos       = $data['mpos_id'];
    $pick_time  = $data['pickTime']; 
    $user = $this->checkUser($email,$hash);
    if ($user)
    {
      if(!$mpos=MPOS::where('id','=',$mpos)->first())
      {
        return response()->json(['error'=>'Mpos not found','code'=>404]);
      }

      $client = new Client();
      $url = $mpos->OGURL;
      if (!empty($url) && strlen($url)>0 && $url[(strlen($url)-1)]=='/')
      {
        $url = substr($url, 0, (strlen($url)-1));
      }

      $res_client = $this->callOGApi($client, 'GET', $url.'/api/utils/parameters', $mpos->OGapiUser, $mpos->OGapipass,[]);
      if ($res_client['status']==200) 
      {
        $res = json_decode($res_client['body']);
        if ($res->code==1000) 
        {
          $og_client_id = $res->parameters->salefinalclient;
        }
        else 
        {
          return response()->json(['error'=>'Fail getting client','code'=>$res->code]);
        }
      }
      else 
      {
        return response()->json(['error'=>'Connection failed ','code'=>204]);
      }
      
      
      if (empty($data['products']) || !is_array($data['products']) || count($data['products'])<=0)
      {
        return response()->json(['error'=>'products is empty!','code'=>406]);
      }
      $produtos_desc_task = "";
      $vouchers = [];
      foreach($data['products'] as $item)
      {
        if (array_key_exists("offer", $item['item']) && $item['item']["offer"]>0) {
          $vouchers[$item['item']["id"]] = $item['item']["offer"];
        }
        $lines[] = [
          "idarticle"     =>  $item['item']['codArtigo'],
          "quantity"      =>  $item['item']['qty'],
          "sellingprice"  =>  $this->calcVATPrice($item['item']['price'], $item['item']['vatid']),
        ];

        $produtos_desc_task .= "&#09;[".$item["item"]["codArtigo"]."] ".$item["item"]["name"]." quantidate: ".$item["item"]["qty"]."<br>";
      }

      $res_order = $this->callOGApi($client, 'POST', $url.'/api/sales/documents/'.env("OG_API_DOCUMENT_TYPE","ENC"), $mpos->OGapiUser, $mpos->OGapipass, [
        'idcustomer'  =>  $og_client_id,
        'lines'       =>  $lines,
      ]);
      if ($res_order['status']==200) 
      {
        $res = json_decode($res_order['body']);
        if ($res->code==1000) 
        {
          $order = new order();
          $order->clientuser_id   = $user->id;
          $order->pickuptime      = $pick_time;
          $order->mpos_id         = $mpos->id;
          $order->og_order_id     = $res->document_number;
          $order->total_price     = $res->document->total;
          $order->save();

          foreach($res->lines as $line)
          {
            foreach ($data["products"] as $item) {
              $camp =$item["item"]["camp"];

              if(!$camp == NULL)
              {
                $campaing = Camp::where('id','=',$camp[0]["id"])->where('product_id','=',$item["item"]["id"])->first();
                $mpos_campaing = MposCamp::where('id','=', $campaing->id)->first();
                $mpos_campaing->quantity -=$line->quantity;
                $mpos_campaing->save(); 
              }
            }
            


           $orderlimit =product_limit::where('product_id','=',$line->idarticle )->first();
          if($orderlimit && $orderlimit->limit == '0')
          {
            return response()->json(['error'=>'product not found','code'=>'404','Time'=>$orderlimit->limit]);

          }
    
            $order_line = new orderDetails;
            $product = product::where('codArtigo','=',$line->idarticle)->first();

            if (empty($product))
            {
              $this->rollbackOrder($order->id);
              return response()->json(['error'=>'product not found','code'=>'404']);
            }

            $order_line->product_id   = $product->id;
            $order_line->price        = $line->sellingprice;
            $order_line->quantity     = $line->quantity;
            $order_line->vatid        = $line->vat;
            $order_line->order_id     = $order->id;
            $order_line->save();
            if($orderlimit > 0)
            {
               $orderlimit->limit -= $line->quantity ;
               $orderlimit->save();
               $new_order_limit = product_limit::where('product_id','=',$line->id )->first();
               if($new_order_limit->limit < 1 )
               {
                $new_order_limit->limit_time = "30";
                $new_order_limit->save();
               }
              
   

            }
         
            if ($order_line->price===0 && array_key_exists($order_line->product_id, $vouchers)) 
            {
              voucher::where('id', $vouchers[$order_line->product_id])->update(['orderline_id' => $order_line->id]);  
            }
          }
          $this->callOGApi($client, 'POST', $url.'/api/crm/tasks/', $mpos->OGapiUser, $mpos->OGapipass, [
            'description'  =>  "Nova Encomenda ",
            'date'       =>  $pick_time,
            'adicionaldescription' => "Encomenda: ".$res->document->documentnumber."<br>Produtos:<br>".$produtos_desc_task,
            'task'=>'T',
            'priority'=>'H'
          ]);
        }
        else 
        {
          return response()->json(['error'=>'Fail creating order','code'=>$res->code]);
        }
      }
      else 
      {
        return response()->json(['error'=>'Connection failed','code'=>204]);
      }
      return response()->json(['success'=>'Order place succefully!','code'=>200]);
    }
    return response()->json(['error'=>'unauthorised user','code'=>401]);
  }    

  public function calcVATPrice($price, $vat_id)
  {
    if ($vat_id=="N") $vat_id="23";
    if (strlen($vat_id)==1) $vat_id = "0".$vat_id;
    return round($price/floatval("1.".$vat_id), 4);
  }
    
  public function rollbackOrder($order_id)
  {
    $res = order::where('id','=',$order_id)->delete();
    $res = orderDetails::where('order_id','=',$order_id)->delete();
    return $res;
  }
    
  public function checkClient($email, $hash) 
  {
    return clientUser::where('email','=',$email)
      ->where('hash','=',$hash)
      ->where('address','!=', null)
      ->where('tax_id','!=',null)
      ->where('zipcode','!=',null)
      ->where('city','!=',null)
      ->first();
  }
  public function getCountries($mpos) 
  {
    try{
        if(!$mpos=MPOS::where('id','=',$mpos)->first()) {
          return response()->json(['result'=>['success'=>false]]);
        }
        $client = new Client();
        $url = $mpos->OGURL;
        if (!empty($url) && strlen($url)>0 && $url[(strlen($url)-1)]=='/')
        {
          $url = substr($url, 0, (strlen($url)-1));
        }

        $res_client = $this->callOGApi($client, 'GET', $url.'/api/utils/parameters', $mpos->OGapiUser, $mpos->OGapipass,[]);
        if($res_client->status==200) {
          if($res_client->code==1000) {
            $res = json_decode($res_client['body']);
            return $res->parameters->countrydefaultcode;    
          } 
        }
        return "NULL";    

    }catch(\Illuminate\Database\QueryException $e){
      return "NULL";
    }
  }
  public function callOGApi($client, $method, $url, $user, $key, $data)
  {
    try {
      $request = $client->request($method, $url, [
        'auth'=>[$user, $key],
        'form_params'=>$data
      ]);
      $status = $request->getStatusCode();
      $body = $request->getBody();
      return [
        'status'=>$status,
        'body'=>$body,
      ];
    } catch (Exception $e) {
      return $e->getResponse();
    }
  }

  public function checkorder(Request $request)
  {
    try{
      $email = $request->input('email');
      $hash = $request->input('hash');

        if( $user= clientUser::where('email','=',$email)->where('hash','=',$hash)->first()){
          $id = $user->id;

          $orders = order::
          
          join('orderLines', function($join) {
            $join->on('orderLines.order_id', '=','order.id');
          })
          ->leftJoin('voucher', function($join) {
            $join->on('orderLines.id', '=','voucher.orderline_id');
          })
          ->leftJoin('MPOS_LOCATION', function($join) {
            $join->on('order.mpos_id','=','MPOS_LOCATION.id');
          })->leftJoin('image',function($join) {
            $join->on('order.mpos_id','=','image.mpos_id')->groupBy('image.url');
          })
            
          ->where('clientUser_id','=',$id)
          // ->whereNotNull('og_order_id')
          ->orderBy('pickupTime', 'DESC')
          ->groupBy('order.id', 'order.clientUser_id', 'order.product_id', 'order.quantity', 'order.pickupTime','order.mpos_id','order.created_at','order.updated_at','order.og_order_id','order.total_price','voucher.orderline_id','MPOS_LOCATION.streetname','image.url')
          ->get(['order.*','voucher.orderline_id','MPOS_LOCATION.streetname','image.url']); //'voucher.orderline_id',
          $orders = $orders->unique("og_order_id");
          $order_arr = [];
          foreach ($orders as $k => $value) {
            $order_arr[]=$value;
          }
          if (count($order_arr)) {
            return response()->json(["result"=>['success'=>true],"data"=>["orders"=>$order_arr]]);
          }
        }
      return response()->json(["result"=>['success'=>false]]);
    } catch(\Illuminate\Database\QueryException $e){ } 
    return response()->json(["result"=>['success'=>false,"message"=>$e]]);
  }
}
