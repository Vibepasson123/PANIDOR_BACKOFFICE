<?php

namespace App\Http\Controllers;

use App\Mpos;
use Sentinel;
use Activation;
use Mail;
use \App\clientUser;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\order;
use App\Camp;
use App\upload_file;
use Validator;
use clietUser;
use \App\product;
use App\Mloaction;
use App\mposSale;
use App\MposCamp;
use App\Mproduct;
use Illuminate\Http\Request;


class posM  extends Controller



{
  public function add_MPOS(Request $request)
  {
    if (Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'master') {

      $mpos = new Mpos;
      $mpos->name = $request->input('name');
      $mpos->discription = $request->input('discription');
      $mpos->OGURL = $request->input('URLog');
      $mpos->OGapiUser = $request->input('userapi');
      $mpos->OGapipass = $request->input('apipass');
      $mpos->save();
      try {

        if ($fetch_product = product::whereNotNull('codArtigo')->get()) {
          foreach ($fetch_product as $newproduct) {

            $newProduct = new product;
            $newProduct->discription = $newproduct['discription'];
            $newProduct->name = $newproduct['name'];
            $newProduct->codArtigo = $newproduct['codArtigo'];
            $newProduct->vatid = $newproduct['vatid'];
            $newProduct->save();
          }
        }
        /*  if($fetchOg_product = product::whereNull('codArtigo')->get()){

                  foreach($fetchOg_product as $new_ogproduct){
                      $ogProductname = $new_ogproduct['name'];
                      $ogDiscription = $new_ogproduct['discription'];
                    
                    $client = new Client();
                    
                    $response = $client->request('POST','https://testesapi.officegest.com/api/stocks/articles',[
   
                      'auth' => ['vivik', 'd5cf4244757ace178666f938d4c77505292e436d'],
                      'form_params'=>[
                          'description'=>$ogProductname,
                          'articletype'=>"N",
                          'vatid'=> "5",
                          'unit'=>"UN",
                      ], 
                          
                      ]
                       
                      );

                      $productstatus=$response->getBody();
                      $prodcut_Code= json_decode($productstatus)->article_id;
                    //  $prodcut_e= json_decode($productstatus)->vatid;


                     $Product_codeArtigo = product::whereNull('codeArtigo')->first();
                     $Product_codeArtigo->codArtigo = $prodcut_Code;
                     $Product_codeArtigo =$prodcut_e;

                     $Product_codeArtigo->save();
                  }
               } */
      } catch (\Illuminate\Database\QueryException $e) { }



      return redirect()->back()->with(['Success' => " MPOS added Successful "]);
    } else

      return redirect()->back()->with(['error' => "PLEASE CHECK THE INPUT "]);
  }


  public function posView($id)
  {

    /* $newid =$id; 
   $userMap= Mpos::where('id','=',$id)->get();
       //$campaign = Camp::with('camppos')->get();  
      /*  $campaign= product::with('camppos',function($query) use($id) {$query->where('mpos_id','=' ,$id);})->where('end_date','=',Carbon::today())->get();
      
       $campaign = Camp::where('mpos_id','=',$id)->where('end_date','<',Carbon::today())->get();   */
    /*  $locations= Mloaction::where('mpos_id','=',$id)->get();
      if(count($locations)  == 0 )
        {
           return redirect()->back()->with(['empty'=>"PLEASE CHECK THE INPUT "]);
        }else 

       foreach($locations as $locid)
        {
          $loc_fid= $locid['id'];
          $lat=$locid['latitude'];
          $long=$locid['longitude'];

         } */

    $newid = $id;
    $userMap = Mpos::where('id', '=', $id)->get();
    foreach ($userMap as $test) {
      $currentloc = $test->MPOS_LOCATION_id;
    }


    //$campaign = Camp::with('camppos')->get();  
    /*  $campaign= product::with('camppos',function($query) use($id) {$query->where('mpos_id','=' ,$id);})->where('end_date','=',Carbon::today())->get();
            
             $campaign = Camp::where('mpos_id','=',$id)->where('end_date','<',Carbon::today())->get();   */
    $locations = Mloaction::where('id', '=', $id)->first();
    if (!$locations) {
      return redirect()->back()->with(['empty' => "PLEASE CHECK THE INPUT "]);
    } else
      /* dd( $locations); */


      $loc_fid = $locations->id;
    $lat = $locations->latitude;
    $long = $locations->longitude;


    $S_tab = mposSale::where('MPOS_LOCATION_id', '=', $loc_fid)->get();

    $get_street = "";
    foreach ($S_tab as $newtab) {
      $sale_street = Mloaction::where('id', '=', $newtab->MPOS_LOCATION_id)->first();

      $get_street = $sale_street->streetname;

      $newtab->street = $get_street;
      /*   $product_name =  */
    }











    $newtab = product::with('salepro')->get();
    $M_order = order::where('mpos_id', '=', $id)->get();

    $discountP = product::whereHas('campaign_Product', function ($query) use ($id) {
      $query->where('mpos_id', '=', $id);
    })->whereHas('campaign_Product', function ($q) {
      $q->where('end_date', '<', Carbon::today());
    })->get();


    $camp2    =  MposCamp::where('mpos_id', '=', $id)->get();
    $campaign =  Camp::whereHas('camp_mpos', function ($query)  use ($id) {
      $query->where('mpos_id', '=', $id);
    })->get();


    return view('mViews.mpos', compact(
      'userMap',
      'locations',
      'S_tab',
      'newtab',
      'long',
      'lat',
      'campaign',
      'M_order',
      'discountP',
      'newid',
      'camp2'
    ));
  }

  public function upView($id)

  {
    $updateValue = Mpos::whereId($id)->first();
    $mpos_image = upload_file::where('mpos_id', '=', $id)->get();

    return view('mViews.updateMpos', compact('updateValue', 'mpos_image'));
  }

  public function updateloc($id)
  {
    $call_id = $id;
    $locationvalue = Mloaction::where('mpos_id', '=', $id)->first();

    if ($locationvalue == NULL) {
      return redirect()->back()->with(['inactive' => 'MPOS NOT ACTIVE']);
    } else {
      return view('mViews.updatelocation', compact('locationvalue', 'call_id'));
    }
  }


  public function updateMpos_location(Request $request)
  {

    try {

      //$mposlocation = $request->input('locationid');
      $ogurl = $request->input('domain');
      $ogapiuser = $request->input('employee_name');


      $v = Validator::make($request->all(), [

        'domain' => 'required',
        'employee_name' => 'required',
        'employee_id' => 'required',
        'active' => 'required'


      ]);


      if ($v->fails()) {
        return response()->json(['error' => "Validation failed ", 'code' => "2001"]);
      }
      $mpos = Mpos::where('OGURL', 'like', '%' . $ogurl . '%')->first();
      if ($mpos) {

        $newlocation = new Mloaction;
        $newlocation->longitude = $request->input("longitude");
        $newlocation->latitude = $request->input("latitude");
        $newlocation->streetname = $request->input("street");
        $newlocation->employee = $request->input("employee_id");
        $newlocation->active = $request->input("active");
        $newlocation->mpos_id = $mpos->id;
        $newlocation->save();

        $mpos->MPOS_LOCATION_id = $newlocation->id;
        $mpos->save();

        return response()->json(['success' => true, 'result' => $request->all()]);
      } else

        return response()->json(['success' => false, 'test' => $employee, 'result' => $request->all()]);
    } catch (\Illuminate\Database\QueryException $e) { }
    return response()->json(['error' => $e]);
  }



  public function updateMpos(Request $request)

  {
    $mpos = $request->input('pos');

    $upMPO = Mpos::find($mpos);

    $upMPO->discription = $request->input('Discription');

    $upMPO->OGURL = $request->input('URLog');

    $upMPO->OGapiUser = $request->input('userapi');

    $upMPO->OGapipass = $request->input('password');

    $upMPO->MPOS_LOCATION_id = $request->input('locationId');

    $upMPO->save();

    return redirect('/Poslist');
  }
  public function locatonUpdate(Request $request)
  {

    $mposlocation = $request->input('locationid');

    $currentMpos_location = Mloaction::where('mpos_id', '=', $mposlocation)->first();


    $currentMpos_location->longitude = $request->input("longitude");

    $currentMpos_location->latitude = $request->input("latitude");

    $currentMpos_location->streetname = $request->input("street");

    $currentMpos_location->employee = $request->input("employee_id");

    $currentMpos_location->active = $request->input("active");

    $currentMpos_location->save();

    return redirect()->back()->with(['locupdate' => " Location Updated successfully "]);
  }
}
