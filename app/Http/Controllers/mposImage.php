<?php
namespace App\Http\Controllers;
use\App\Mpos;
use Sentinel;
use Activation;
use \App\clientUser;
use\App\User; 
use Carbon;
use\App\upload_file;
use\App\voucher;
use \App\og_client;
use Hash;
use File;
use Validator;
use GuzzleHttp\Client;
use \App\Mlocation;
use \App\product;
use\App\invitation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class mposImage extends Controller
{

    private function generate_file_name($product_id, $ext) {
        $file_name = $product_id.'_'.date("ymdHis").'_'.str_random(4).$ext;
        try {
            if($contents = Storage::get('public/upload/'.$file_name)) {
                $this->generate_file_name($product_id, $ext);
            }
        }catch (\Exception $e) {
            return null;
        }
        return $file_name;
    }

    public function storeImage(Request $request) { 
        if($request->hasfile('image')) {
            $mpos_id = $request->input('mpos');
            $file = $request->file('image');
            $ext = substr($file->getClientOriginalName(), -4);
            $getFileName = $request->file('image')->getClientOriginalName();
            $file_name = $this->generate_file_name('mpos_'.$product_id, $ext);
            if ($file_name!=null) {
                try {
                    if($strogePath=$request->file('image')->storeAs('public/upload', $file_name)) {
                        Storage::setVisibility($strogePath, 'public');
                        $getFileName2 = $request->file('image')->hashName();
                        $test = $request->file('image')->getPathName();
                        $file_details  = new upload_file;
                        $file_details->filename = $getFileName;
                        $file_details->file_id = $file_name;
                        $file_details->url =  url('/')."/storage/app/".$strogePath;
                        $file_details->image_class = "MP";
                        $file_details->mpos_id = $mpos_id;
                        $file_details->selected = $request->input('selected');
                        $file_details->save();
                        return redirect()->back()->with('success', ['image Uploaded']);   
                    }
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', [$e->getMessage()]);
                }
            } else {
                return redirect()->back()->with('error', ['Generating image name!']);
            }
        } else {
            return redirect()->back()->with('error', ['Image empty!']);
        } 
    }

    public function productImage(Request $request) {
        if($request->hasfile('image')) {
            $product_id = $request->input('product');
            $file = $request->file('image');
            $ext = substr($file->getClientOriginalName(), -4);
            $getFileName = $request->file('image')->getClientOriginalName();
            $file_name = $this->generate_file_name('product_'.$product_id, $ext);
            if ($file_name!=null) {
                try {
                    if($strogePath=$request->file('image')->storeAs('public/upload', $file_name)) {
                        Storage::setVisibility($strogePath, 'public');
                        $getFileName2 = $request->file('image')->hashName();
                        $test = $request->file('image')->getPathName();
                        $file_details  = new upload_file;
                        $file_details->filename = $getFileName;
                        $file_details->file_id = $file_name;
                        $file_details->url =  url('/')."/storage/app/".$strogePath;
                        $file_details->image_class = "PRP";
                        $file_details->product_id = $product_id;
                        $file_details->selected = $request->input('selected');
                        $file_details->save();
                        return redirect()->back()->with('success', ['image Uploaded']);   
                    }
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', [$e->getMessage()]);
                }
            } else {
                return redirect()->back()->with('error', ['Generating image name!']);
            }
        } else {
            return redirect()->back()->with('error', ['Image empty!']);
        }
    }


 public function deleteImage(Request $request)
   {
         $image_file_id = $request->image_file_id;
         $id = $request->id;
       
            
            if ($contents = Storage::get('public/upload/'.$image_file_id))
                {
                    $getfile = Storage::delete('public/upload/'.$image_file_id); 
                    $delete_image =upload_file::where('id','=', $id)->delete();
                    return response()->json( 'Deleted');
                }  
              return response()->json( 'Error');
       



    } 
 
}
