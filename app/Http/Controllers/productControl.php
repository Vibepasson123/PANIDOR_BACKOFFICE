<?php

namespace App\Http\Controllers;
use App\product;
use App\Mpos;
use\App\upload_file;
use Illuminate\Http\Request;

class productControl extends Controller
{
    
   public function getProduct()
   {

     $productList = product::all();
     $mpos   = Mpos::all();
     
     

     return view( 'products.product',compact('productList','mpos') );


   }


     public  function productDeatilsImage(Request $request)

     {
        $product_id = $request->id;

          if($productImage = upload_file::where('product_id','=', $product_id)->first())
          {
            $image = $productImage->url;
            return response()->json($image);
          }else
          {
            return response()->json('noImage');
          }
        

     }
    public function allImageDetails(Request $request)
    {
      $image_id = $request->id;
      if($product_image = upload_file::where('id','=',$image_id)->first())
      {
        $image = $product_image->url;
        return response()->json($image);

      }else
      {
        return response()->json('noImage');
      }
    }
   



}
