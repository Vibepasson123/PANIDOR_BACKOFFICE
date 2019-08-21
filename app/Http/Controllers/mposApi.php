<?php
namespace App\Http\Controllers;
use\App\Mpos;
use Sentinel;
use Activation;
use \App\clientUser;
use\App\User; 
use Carbon;
use\App\voucher;
use \App\og_client;
use Hash;
use\App\upload_file;
use Validator;
use GuzzleHttp\Client;
use \App\Mloaction;
use \App\product;
use\App\Camp;
use\App\MposCamp;
use\App\invitation;
use Illuminate\Http\Request;


class mposApi extends Controller
{

  public function createApiUser(Request $request )
  {  
    
    try{
        $user= $request->input('email');
        $mobile = $request->input('mobile');
        $password = $request->input('password');

        $v = Validator::make($request->all(), [
          'email' => 'required|email',
          'password' => 'required|min:5',
          'mobile'=>'required|min:5',      
      ]);
  
      if ($v->fails())
      {
        return response()->json( ['result'=>['success'=>false,],'data'=>[ 'email'=>$user,'password'=>'*******','mobile'=>$mobile,'Validation Faild']]);
      
      }
        if($checkClient = clientUser::where('email','=',$user)->first()){
          return response()->json( ['result'=>['success'=>false],'data'=>[ 'user already esist']]);
       
      }else{  
         $client = new clientUser;
         $client->email =$request->input('email');
         $client->password=Hash::make($password);
         $client->mobile = $request->input('mobile');
         $client->save();
        if($invitation = invitation::where('invitaion_num','=',$mobile)->whereNull('status')->first())
        {  
            $client_id = $invitation['clientUser_id'];
               $invitation->status = "2"; 
               $invitation->save();
          if( $Client_point = voucher::where('client_id','=',$client_id)->first()){
            $voucher_point = $Client_point['voucherPoint']+"2";
            $Client_point->voucherPoint = $voucher_point;
            $Client_point->save();
          }else
              $newVoucherPoint = new voucher;
              $newVoucherPoint->voucherPoint = "2";
              $newVoucherPoint->client_id=$client_id;
              $newVoucherPoint->save();
            if($userVoucher =voucher::where('client_id','=',$client_id)->whereNull('voucher')->first() ){
           if($check_voucher = voucher:: where('client_id','=' ,$client_id)->where('voucherPoint','>=',"10")->first()){
               $Og_client = voucher::where('client_id','=',$client_id)->first();
              $check_voucher->voucher = md5(microtime());
              $check_voucher->save();


               if($balance_point = og_client:: where('client_id','=' ,$client_id)->where('voucherPoint','>',"10")->first()){
                $balance_point->voucherPoint  = $Client_point['voucherPoint']-"2";
                $balance_point ->save();
              } 
              $reslut=[
               
                'Result'=>'User Created ',
                'voucher'=>true,
                $client_id
              ];
              return response()->json( ['result'=>[ 'success'=>true,],'data'=>$result]);
            

           }
          }

        }else
         $result2=[
        
          'Result'=>'User Created ',
         
         ];

         return response()->json( ['result'=>['success'=>true,],'data'=>$result2]);
            
      }

   }
   catch(\Illuminate\Database\QueryException $e){

   }
  }

  public function createFBUser(Request $request )
  {  
    
    try{
        $user= $request->input('email');
        $password = $request->input('password');

        $v = Validator::make($request->all(), [
          'email' => 'required|email',
          'password' => 'required'
      ]);
  
      if ($v->fails())
      {
        return response()->json( ['result'=>['success'=>false, "message"=>$v],'data'=>[ 'email'=>$user,'password'=>'*******','Validation Faild']]);
      
      }

      if($checkClient = clientUser::where('email','=',$user)->first()){
        $checkClient->fb_userid=$password;
        $checkClient->save();
        return response()->json( ['result'=>[ 'success'=>true,]]);
      
      }else{  
         $client = new clientUser;
         $client->email =$request->input('email');
         $client->password=$password;
         $client->fb_userid=$password;
         $client->save();
        return response()->json( ['result'=>[ 'success'=>true,]]);
       }
   }
   catch(\Illuminate\Database\QueryException $e){
    return response()->json( ['result'=>[ 'success'=>false, "message"=>$e]]);
   }
  }
  
   public function login(Request $request)
   {
   
    try{
      $user= $request->input('email');
      $pass=$request->input('password');
      $fb = $request->input('fb');
      $hashed = Hash::make('plain-text');

      $checkClient = clientUser::where('email','=',$user)->first();
      if($checkClient){
        $newclient= clientUser::where('fb_userid',$fb)->first();
          if($newclient) {
            $token = md5(microtime());
            $newclient->hash=$token;
            $newclient->save();
            return response()->json( ['result'=>['success'=>true,],'data'=>["hash"=>$token]]);
          }
      } 
      if($checkClient && Hash::check($pass, $checkClient->password)){

        $newclient= clientUser::where('email','=',$user)->first();
        $token = md5(microtime());
        $newclient->hash=$token;
        $newclient->save();
        return response()->json( ['result'=>['success'=>true,],'data'=>["hash"=>$token]]);
       
      } else {
        return response()->json( ['result'=>['success'=>false, ],'data'=>['password not authenticated' ]]);
      }
  
    }catch(\Illuminate\Database\QueryException $e){
      return response()->json( ['result'=>['success'=>false],'data'=> $e]);
    }  

   }


  public function mposLocation(Request $request)
  {
    $email = $request->input('email');
    $hash = $request->input('hash');
    $mpos = $request->input('mpos');
     
      if( $user= clientUser::where('email','=',$email)->where('hash','=',$hash)->first()){
          
        $mpos = Mpos::all();
        
        //$M2 = Mpos::whereHas('mloc',function ($query) use($mpos){ $query->where('mpos_id','=', $mpos);})->get(); 

        
        foreach($mpos as $newmi)

        {
            $newmi->mloc = Mloaction::where('mpos_id','=',$newmi->id)->orderBy("id",'DESC')->first();
            $mpos_image= upload_file::where('mpos_id','=',$newmi->id)->where('image_class','=','MP')->get();
            $newImage=[];
              foreach($mpos_image as $image)
               { 
                $newImage[] = $image->url;
               }

     
            $newmi->images =$newImage;
        }
     
       

    
        return response()->json( ['result'=>['success'=>true],'data'=>["mpos_location_data"=>$mpos]]);

      }else 
      
    return response()->json( ['result'=>['success'=>false],'data'=>[ 'Unthorised User' ]]);
 
  }

  public function getproduct(Request $request)

  {
   
    $email = $request->input('email');
    $hash = $request->input('hash');
    $mmpos =$request->input('mpos');

    $mpos_product = MPOS::whereHas('productmpos',function ($query) use($mmpos){ $query->where('mpos_id','=', $mmpos);})->get();
    $mpos=MPOS::where('id','=',$mmpos)->first();

    $this->syncPrices($mpos,$mpos_product);
  
   
    if( $user= clientUser::where('email','=',$email)->where('hash','=',$hash)->first()){   
/*           
    $offerproduct = product::with('campaing_Product')->get(); */
    
        $offerproduct = product::whereHas('campaign_Product' ,function($query)
         use($mmpos) {$query->where('mpos_id','=',$mmpos);
          }) ->whereHas('campaign_Product', function($q){ $q->where('end_date','>' ,Carbon\Carbon::today() )->where('quantity','>',0);
          })->get(); 
         
          foreach($offerproduct as $O_product)

          {
            $Mpos_camp = MposCamp::where('product_id','=',$O_product->id)->get();
            foreach($Mpos_camp as $newCamp)
            {
              $camp = Camp::where('id','=',$newCamp->camp_id)->get();
            }
          
              $OP_image= upload_file::where('product_id','=',$O_product->id)->where('image_class','=','PRP')->get();
              $offer_image=[];
                foreach($OP_image as $image)
                 { 
                  $offer_image[] = $image->url;
                 }
  
              $O_product->images =$offer_image;
              $O_product->camp =$camp;
          }


           $mpos_product = product::whereHas('productmpos',function ($query) use($mmpos){ $query->where('mpos_id','=', $mmpos);})->get();

        foreach($mpos_product as $M_product)

        {
         
            $mpos_image= upload_file::where('product_id','=',$M_product->id)->where('image_class','=','PRP')->get();
            $MP_image=[];
              foreach($mpos_image as $image)
               { 
                $MP_image[] = $image->url;
               }

     
            $M_product->images =$MP_image;
        }
          $products= product::all();

       
          foreach($products as $all_products)

          {
           
              $all_product_image= upload_file::where('product_id','=',$all_products->id)->where('image_class','=','PRP')->get();
              $AP_image=[];
                foreach($all_product_image as $image)
                 { 
                  $AP_image[] = $image->url;
                 }
  
       
              $all_products->images =$AP_image;
          }






          $result  = [
            
            'offerproduct'=>$offerproduct,
            'mposProduct'=> $mpos_product,
             'all_products'=>$products,
          ];
         
         // return response()->json($offerproduct,$products);
      return response()->json( ['result'=>['success'=>true,],'data'=>$result]);
     }else 


  
    return response()->json( ['result'=>['success'=>false],'data'=>[ 'Unthorised User' ]]);
 
  
  }
public function checkhash(Request $request)
{ 


  try{


    $email = $request->input('email');
    $hash = $request->input('hash');
    if( $user= clientUser::where('email','=',$email)->where('hash','=',$hash)->first()){ 

       $has = $user->hash;

      /*   return response($token); */
        return response()->json( ['result'=>['success'=>true],'data'=>['hash'=>$has,]]);
    


    }else
    return response()->json( ['result'=>['success'=>false, 'Unthorised User' ]]);

  }catch(\Illuminate\Database\QueryException $e){
      
       }  return response()->json( ['result'=>[ 'success'=>false,'Unthorised User' ]]);




}
public function update_cleint(Request $request)
{ 

  
      try{
          $email = $request->input('email');
          $hash = $request->input('hash');
         // $mobile = $request->input('mobilenumber');
          $add = $request->input('address');
          $city = $request->input('city');
          $tax = $request->input('taxid');
          $code =  $request->input('zipcode');
      
     if( $user= clientUser::where('email','=',$email)->where('hash','=',$hash)->first()){
             $id = $user->id;
             sleep(2);
            $updateClient = clientUser::where('email','=',$email)->first();
           // $updateClient->mobile = $mobile; 
            $updateClient->address = $add;
            $updateClient->tax_id = $tax;
            $updateClient->zipcode =  $code;
            $updateClient->city= $city;

            $updateClient->save();
            $result=[
              'success'=>true,
              'address'=>$add,
              'city'=>$city,
              'tax'=>$tax,
              'zipcode'=>$code,
            ];
            $result2=[
              'success'=>false,
              'address'=>$add,
              'city'=>$city,
              'tax'=>$tax,
              'zipcode'=>$code,
            ];

         /// if($voucherpoint = invitation::where('invitaion_num','=',))
 


         return response()->json( ['result'=>['data'=>$result]]);

   }else
   return response()->json( ['result'=>['data'=>$result2]]);



  }catch(\Illuminate\Database\QueryException $e){
    
  }
}

   public function getClientDetails(Request $request)
   {
    try{
      $email = $request->input('email');
      $hash = $request->input('hash');
      if( $user= clientUser::where('email','=',$email)->where('hash','=',$hash)->first()){
        $ClientDetails = clientUser::where('email','=',$email)->first();

        return response()->json( ['result'=>['success'=>true],'data'=>["user_data"=>$ClientDetails]]);
        
      }else
      return response()->json( ['result'=>['success'=>false]]);

     
    }catch(\Illuminate\Database\QueryException $e){
    
    }
   }

  public function getMposEmail(Request $request) {
    try{
      $email = $request->input('email');
      $hash = $request->input('hash');
      $mpos = $request->input('mpos');

      if( $user= clientUser::where('email','=',$email)->where('hash','=',$hash)->first()){
        if(!$mpos=MPOS::where('id','=',$mpos)->first()) {
          return response()->json(['result'=>['success'=>false]]);
        }
        $client = new Client();
        $url = $mpos->OGURL;
        if (!empty($url) && strlen($url)>0 && $url[(strlen($url)-1)]=='/')
        {
          $url = substr($url, 0, (strlen($url)-1));
        }

        $res_client = $this->callOGApi($client, 'GET', $url.'/api/entities/employees?filter[name]='.$mpos->OGapiUser, $mpos->OGapiUser, $mpos->OGapipass);
        $res = json_decode($res_client['body']);
        $res = (array)$res->employees;
        foreach ($res as $key => $value) {
          $data = $value; break;
        }         
        return response()->json( ['result'=>['success'=>true],'data'=>["user_data"=>$data]]);
        
      }else
        return response()->json( ['result'=>['success'=>false]]);

     
    }catch(\Illuminate\Database\QueryException $e){
    
    }
  }

  public function callOGApi($client, $method, $url, $user, $key) {
    try {
      $request = $client->request($method, $url, [
        'auth'=>[$user, $key]
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

  public function syncPrices($mpos, $products) {
    try {

      foreach ($products as $product) {
        if ($product->codArtigo == "" || $product->codArtigo == NULL) {
          continue;
        }
        if($product->updated_at < (new \Carbon\Carbon())->subHours(4)) {
          $client = new Client;
          $url = $mpos->OGURL;
          $response = $this->callOGApi($client,'GET',$url."/api/stocks/articles/".base64_encode($product->codArtigo),$mpos->OGapiUser, $mpos->OGapipass);
          $res = json_decode($response['body']);
          
          if ($res->code == 1000) {
            $vat = $res->article->vatid;
            $vat_percentage = null;
            try {
                $getVat = new Client();
                $response = $getVat->request('GET',$url.'/api/tables/vats?filter[id]='.$vat,[
                    'auth'=>[$mpos->OGapiUser, $mpos->OGapipass],
                    ]);
                $body = $response->getBody();
                $resVat = json_decode($body);
                //var_dump($body);
                if($resVat->code === 1000) {
                    foreach ($resVat->vats as $key => $value) {
                        if($value->id == $vat) {
                            $vat_percentage = $value->value; break;
                        } 
                    }
                }
            }catch (\GuzzleHttp\Exception\ConnectException $e) {
                die();
            }

            if($vat_percentage === null) {
                die();
            }
            $vatid = ($vat_percentage / 100.0) + 1;

            $updateProduct = product::where('id','=',$product->id)->first();
            $updateProduct->price = $res->article->sellingprice * $vatid;
            $updateProduct->save();
          }
        }
      }
    } catch (Exception $e) {
      return $e->getResponse();
    }
  }
}