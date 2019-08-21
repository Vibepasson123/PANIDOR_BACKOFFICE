<?php

namespace App\Http\Controllers;
use\App\Mpos;
use Carbon\Carbon;
use\App\Camp;
use\App\MposCamp;
use App\Mloaction;
use App\product;

use Illuminate\Http\Request;

class campaing extends Controller
{
    public function Tcamp($id)

    {
        $detailsM= Camp::where('id','=',$id)->first();
        if($detailsM == NULL){
            return redirect()->back()->with(['error'=>'Somthing went Wrong']);
        }
        $product_name = product::where('id','=', $detailsM->product_id)->first();
        $campMpos= Mpos::all();
        $campproduct = product::all();
       /*  $camp= Camp::whereHas('camp_status',function($query )  { $query->where('status','=', 1); 
      
        })->get(); */
    
       $camp= Camp::whereHas('camp_status',function ($q) use($id){ $q->where('camp_id','=',$id);
        })->get(); 
       return view('camp.campaign',compact('camp','detailsM','campMpos','campproduct','product_name'));
      
    }


    public function getcamp()

    {
       $camplist= Camp::with('camp_status')->get();
       $campproduct = product::all();
       $campMpos= Mpos::all();
       return view('camp.campainList',compact('camplist','campproduct','campMpos'));
    }


    public function setCamp(Request $request)

    {   
        if($request->input('mpos')== 0){
            return redirect()->back()->with(['error'=>'Somthing went Wrong']);   
        }
        
        if($request->input('product')== 0){
            return redirect()->back()->with(['error'=>'Somthing went Wrong']);   
        }

      
         $frm      =      $request->input('start_Date');
         $to       =      $request->input('endDate');
         $to_date  =      Carbon::parse($to)->format('Y-m-d h:i:s');
         $frm_date =      Carbon::parse($frm)->format('Y-m-d h:i:s');
         $MP_id    =      $request->input('mpos');
         $CM_id    =      $request->input('camp_id');
         $MCpos    =      Mpos::where('id','=',$MP_id)->first();
         $MCC      =      Camp::where('id','=',$CM_id)->first(); 
         
            $Mpos_name =      $MCpos->name;
            $MCpos->campp()->attach($MCC);
          
              $setCamp = MposCamp::where('mpos_id','=', $MP_id)->where('created_at','>=', carbon::now())->first();
           
                $setCamp->start_date =  $frm_date;
                $setCamp->end_date =  $to_date;
                $setCamp->camp_mpos_name = $Mpos_name;
                $setCamp->quantity = $MCC->quantity;
                $setCamp->product_id=$request->input('product');
                $setCamp->save();
         /*        if($frm < $to )
                {
                    dd('yes');

                }
                else 
                {
                    dd('fuck');} */
                 
             
                return redirect()->back()->with(['sucess'=>'Added successfully']); 
        
        
         
    }


    public function addcampaign(Request $request)

    {
       try{ 

        $camp = new Camp ;
        $camp->name = $request->input('name');
        $camp->discription= $request->input('discription');
        $camp->product_id = $request->input('product_id');
        $camp->quantity= $request->input('quantity');
        $camp->price = $request->input('price');
        $camp->type_id = "1"; 
        $camp->save();
           return redirect()->back()->with(['sucess '=>'Added successfully']);
        
     }catch(\Illuminate\Database\QueryException $e){
      /*  dd($e); */
    } 

    }

    public function  deactCamp(Request $request)
    { 
        $dactVal = 0;
        $deactID = $request->input('id');
        try{
        $deact = MposCamp::where('id','=',$deactID)->first();
        $deact->status=$dactVal;
        $deact->save();
        return response()->json(['this'=>"is working"]);
         }catch(\Illuminate\Database\QueryException $e){
      return redirect()->back()->with(['error'=>'Somthing went Wrong']);
          }

    }


    public function actCamp(Request $request)

    {
      $actVal = 1;
      $act = $request->input('id');

      try{
          $activate= MposCamp::where('id','=',$act)->first();
          $activate->status=$actVal;
          $activate->save();
          return redirect()->back()->with(['sucess '=>'Acivated Successfully']);
      }catch(\Illuminate\Database\QueryException $e){
          return redirect()->back()->with(['error'=>'Somthing went Wrong']);
    }
   


    }


}
