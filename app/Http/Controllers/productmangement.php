<?php

namespace App\Http\Controllers;
use Sentinel;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\product;
use Carbon\Carbon;
use\App\upload_file;
use App\Mloaction;
use App\mposSale;
use Validator;
use App\Mpos;

class productmangement extends Controller
{

  public function addProduct_local(Request $request)
  {

   
    $data = $request->all();

    $productName = $data['product_name'];
    $productDriscription = $data['product_discription'];
    $article = $data['article'];

    $test = product::where('codArtigo','=',$article)->first();
   
       if($test ==NULL){
        try{ 
        $panidorProduct = new product;
        
        $panidorProduct->name                 =$productName;
        $panidorProduct->discription          =$productDriscription;
        $panidorProduct->codArtigo            =$article;
  
  
        $panidorProduct->save();
      
      }catch(\Illuminate\Database\QueryException $e){
        // return response()->json([ 'success'=> false ,'msg' =>"Please check the data"  ]);
        return redirect()->back()->with('msg',"Please check the data")->with('success',false)->withInput();
      } 
        //return response()->json([ 'success'=> true ,'msg' =>"Prodcut Added successfully"  ]);
        return redirect('/Products')->with('msg',"Prodcut Added successfully")->with('success',true);
       
       }
    //return response()->json([ 'success'=> false ,'msg' =>"Please check the data"  ]);
    return redirect()->back()->with('msg',"Please check the data")->with('success',false)->withInput();
  }

  public function addProduct(Request $request)
  {
    $is_valid = Validator::make($request->all(),[
      'product_name'          =>'required',
      'vat_id'                =>'required',
      'product_discription'   =>'required',
      'product_price'         =>'required',
      'article'               =>'required'
    ]);

    if ($is_valid->fails())
    {
      return response()->json(['error'=>"Validation failed",'code'=>"2001"]);
    }

    $ogProductname        = $request->input('product_name');
    $ogVat                = $request->input('vat_id');
    $og_shortdiscription  = $request->input('product_discription');
    $og_price             = $request->input('product_price');
    $article              = $request->input('article');

    try
    {
      if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug !='client')
      {
        if (!$panidorProduct=product::where('codArtigo','=',$article)
          ->where('price','=',$og_price)
          ->where('vatid','=',$ogVat)
          ->where('short_description','=',$og_shortdiscription)
          ->where('name','=',$ogProductname)
          ->first()
        ) {
          $panidorProduct = new product;
  
          $panidorProduct->name                 =$ogProductname;
          $panidorProduct->discription          =$ogProductname;
          $panidorProduct->codArtigo            =$article;
          $panidorProduct->vatid                =$ogVat;
          $panidorProduct->price                =$og_price;
          $panidorProduct->short_description    =$og_shortdiscription;
  
          $panidorProduct->save();
        }

        $mpos = mpos::all();
        $client=new Client();
        foreach($mpos as $mposlist)
        {
          $url = $mposlist->OGURL;
          if (!empty($url) && strlen($url)>0 && $url[(strlen($url)-1)]=='/')
          {
            $url =substr($url, 0, (strlen($url)-1));
          }
        
          $ogApiPass = $mposlist->OGapipass;
          $ogUser = $mposlist->OGapiUser;

          $res = $this->callOGApi($client, 'GET', $url.'/api/stocks/articles/'.$article, $ogUser, $ogApiPass);
          if ($res['status']==200)
          {
            $res_json = json_decode($res['body']);
            if ($res_json->code == 2005)
            {
              $res_post = $this->callOGApi($client, 'POST', $url.'/api/stocks/articles', $ogUser, $ogApiPass, [
                'id'                  =>  $article,
                'description'         =>  $ogProductname,
                'articletype'         =>  "N",
                'vatid'               =>  $ogVat,
                'unit'                =>  "UN",
                'short_description'   =>  $og_shortdiscription,
                'sellingprice'        =>  $this->calcVATPrice($og_price, $ogVat)
              ]);
              
            }
          }
        }
        return redirect()->back()->with(['SUCCESS'=>'PRODUCT ADD SUCCESSFULLY']);
      }
      return redirect()->back()->with(['FAILED'=>"AUTHENTICATION DENIED"]);
    } 
    catch(\Exception $e) 
    { 
      return redirect()->back()->with(['FAILED'=>$e]); 
    }
  }
  
  public function calcVATPrice($price, $vat_id)
  {
    if ($vat_id=="N") $vat_id="23";
    if (strlen($vat_id)==1) $vat_id = "0".$vat_id;
    return round($price/floatval("1.".$vat_id), 2);
  }

  public function callOGApi($client, $method, $url, $user, $key, $data=array())
  {
    try 
    {
      $request=$client->request($method, $url, [
        'auth'=>[$user, $key],
        'form_params'=>$data
      ]);
      $status=$request->getStatusCode();
      $body=$request->getBody();
      return [
        'status'=>$status,
        'body'=>$body,
      ];
    } 
    catch (\Exception $e) 
    {
      return $e->getResponse()->getReasonPhrase();
    }
  }

  public function getproduct($id)
  {
    try{
    $call_id = $id;
    $product_image = upload_file::where('image_class','=','PRP')->where('product_id','=',$call_id)->get();
    $product = product::where('id','=',$id)->get();
    $mpos = Mpos::all();
    return view('products.updateProduct',compact('product','call_id','mpos','product_image'));
    }
    catch (\Exception $e) 
    {
     
    }

   
  }

  public function updateproduct(Request $request)
  {
    $name = $request->input('name');
    $codArtigo = $request->input('codArtigo');
    $vatid = $request->input('vat_id');
    $shortDiscription = $request->input('short');
    $discription = $request->input('discription');
    $price = $request->input('price');
    $id = $request->input('id');
    $mpos_id = $request->input('mpos_id');

    if($product = product::where('id','=',$id)->first())
    {
      if (!empty($name) || (string) $name ==="0")$product->name = $name;
      if (!empty($codArtigo) || (string) $codArtigo ==="0")$product->codArtigo =  $codArtigo;
      if (!empty($vatid) || (string) $vatid ==="0")$product->vatid = $vatid;
      if (!empty($shortDiscription) || (string)  $shortDiscription ==="0")$product->short_description =  $shortDiscription;
      if (!empty($discription) || (string) $discription ==="0")$product->discription =  $discription;
      if (!empty($price) || (string)  $price  ==="0")$product->price =$price;

      $product->save();
      if (!empty($mpos_id)){
        $att_product =  product::where('id','=',$id)->first();
        $mpos = Mpos::where('id','=',$mpos_id)->first();
        $mpos->productmpos()->attach($att_product);
       
      }
        
      
      return redirect()->back()->with(['locupdate'=>" Location Updated successfully "]);
    }
  }


   public function sync()
   {
     $mpos = Mpos::all();
     foreach($mpos as $mposlist)
     {
       $url = $mposlist->OGURL;
       if (!empty($url) && strlen($url)>0 && $url[(strlen($url)-1)]=='/')
       {
         $url =substr($url, 0, (strlen($url)-1));
       }
 
       $usrname = $mposlist->OGapiUser;
       $password = $mposlist->OGapipass;
       $mpos_id = $mposlist->id;
       $mpos_location_id = $mposlist->MPOS_LOCATION_id;
 
       $products = product::all();
 
       $body = [];
       foreach($products as $article)
       {
         $body['articles'][] = $article->codArtigo;
       }
 
       if ($date=mposSale::max('date_time'))
       {
         $body['date'] = $date;
       }
       
 
       try {
         $client = new Client();
         $request = $client->request('POST', $url.'/api/addon/posmovel/get_articles_sales', [
           'auth'=>[$usrname, $password],
           'form_params'=>$body
         ]);
         $status = $request->getStatusCode();
         if($status == 200)
         {
           $productstatus = $request->getBody();
           $res = json_decode($productstatus);
           if ($res->total>0) 
           {
             foreach($res->articles as $article)
             {
               if($product=product::where('codArtigo','=',$article->article_id)->first())
               {    
                 $newsale = new mposSale;
                 $newsale->product_id = $product->id;
                 $newsale->quntity = $article->qty_sum;
                 $newsale->price = $article->selling_price;
                 $newsale->code_Artigo = $article->article_id;
                 $newsale->og_invoice_id = $article->doc_num;
                 $newsale->og_invoice_type = $article->doc_type;
                 $newsale->date_time = $article->date;
                 $newsale->mpos_id = $mpos_id;
                 $newsale->MPOS_LOCATION_id = $mpos_location_id;  
                 $newsale->save();
               }
             }
           }
          }
          else
          {
            return redirect()->back()->with(['FAIL'=>"ERROR while Syncing."]);
          }
        } catch (\Guzzle\Http\Exception\ConnectException $e) 
        {
            return redirect()->back()->with(['FAIL'=>"ERROR while Syncing."]);
        } catch (\Exception $e) 
        {
          return redirect()->back()->with(['FAIL'=>"ERROR while Syncing."]);
        }
        return redirect()->back()->with(['SYNC'=>"Synced Successfully."]);
     }
   }

 /* public function sync()
 {
    $mpos = Mpos::all();
    foreach($mpos as $mposlist)
    {

      $url = $mposlist->OGURL;
      $usrname = $mposlist->OGapiUser;
      $password = $mposlist->OGapipass;
      $mpos_id = $mposlist->id; 
       
      $client = new Client();

      $response =   $client->request('GET',$url.'/api/sales/documents/FS',[
           
         'auth' => [$usrname, $password],
   
   
      ]);
      
      $productstatus = $response->getBody();
      
      $prodcut_Code= json_decode($productstatus)->documents;
      
   
   
   
      foreach($prodcut_Code as $documentCode)
      {
   
      $invoice_number  = $documentCode->number;
      $invoice_date = $documentCode->systemdate;
      
      if($location =Mloaction::where('mpos_id','=',$mpos_id)->first() ) {
       $location_date = $location->date_time;
      if($invoice_date == $location_date)
      {
       $invoiceDetails = new Client();
             $invoiceDetailsResponse = $invoiceDetails->request('GET',$url.'/api/sales/documents/FS/'.$invoice_number,[
               'auth' => [$usrname, $password],
               ]);
               $invoiceStatus=$invoiceDetailsResponse->getBody();
      
               $invoiceFS= json_decode($invoiceStatus)->lines;
   
              foreach($invoiceFS as $invoiceFSdetails)
              {   
                  $article_id = $invoiceFSdetails->idarticle;
                 /*  $test = $invoiceFSdetails->quantity; */
                /*   if($product = product::where('codArtigo','=', $article_id  )->first())
                  {    $current_product_id = $product->id;

                   //  dd($current_product_id);
                        $newsale = new  mposSale;
                        $newsale->product_id =$current_product_id;
                        $newsale->quntity = $invoiceFSdetails->quantity;
                        $newsale->price = $invoiceFSdetails->sellingprice;
                        $newsale->code_Artigo = $article_id;
                        $newsale->og_invoice_id = $invoice_number;
                        $newsale->date_time = $invoice_date;
                        $newsale->mpos_id =$mpos_id;
                        $newsale->MPOS_LOCATION_id =$location->id;  
                        $newsale->save();
                        
                        return redirect()->back()->with(['ADDPRODUCT'=>" PRODUCT ADDED SUCCESSFUL "]);


   
                  }

               }
           
            }  
            return redirect()->back()->with(['ADDPRODUCT'=>" PRODUCT ADDED SUCCESSFUL "]);
         }
      }
    }
 }

 */ 
}
