<?php

namespace App\Http\Controllers;

use \App\Mpos;
use Sentinel;
use Activation;
use \App\clientUser;
use \App\User;
use Carbon\Carbon;
use \App\Mlocation;
use \App\product;
use \App\order;
use \App\voucher;
use \App\invitation;
use Illuminate\Http\Request;

class manageinvitationAPI extends Controller
{
  public function invitation(Request $request)
  {
    try {
      $email = $request->input('email');
      $hash = $request->input('hash');
      $int_num = $request->input('phone_number');

      if ($user = clientUser::where('email', '=', $email)->where('hash', '=', $hash)->first()) {

        $id = $user->id;
        $invite = new invitation;
        $invite->clientUser_id = $user['id'];
        $invite->invitation_num = $int_num;
        $invite->save();

        return response()->json(['success' => "'Invitation Added',$user->first_name "]);

      }
    } catch (\Illuminate\Database\QueryException $e) {

     }
      return response()->json(['error' => $e]);
  }

  public function RequestInvitation(Request $request)
  {
    try {
      $email = $request->input('email');
      $hash = $request->input('hash');

      if ($user = clientUser::where('email', '=', $email)->where('hash', '=', $hash)->first()) {
        $id = $user->id;
        $res = $user->email;

          if ($inv_request = invitation::where('clientUser_id', '=', $id)->get()) {

            return response()->json(["result" => ['success' => true], "data" => ["invited_numbers" => $inv_request]]);

          } else

            return response()->json(["result" => ['success' => false]]);
      } else

        return response()->json(["result" => ['success' => false]]);

    } catch (\Illuminate\Database\QueryException $e) { }
  }

  public function getPoints(Request $request)
  {
    try {
      $email = $request->input('email');
      $hash = $request->input('hash');

      if ($user = clientUser::where('email', '=', $email)->where('hash', '=', $hash)->first()) {

        $id = $user->id;
        $res = $user->email;

        if ($offer = voucher::where('client_id', '=', $id)->where('voucherPoint', '>', '9')->where('orderline_id', '=', null)->first()) {

          if (!is_null($offer->product_id)) {

            $prod = product::where('id', '=', $offer->product_id)->first();
            
            return response()->json([
            "result" => ['success' => true], "data" => 
            ['msg' => "It looks like you have won a \"" .
            $prod->discription . "\"\nReclaim it on your next order 🎁", 'data' => $offer,
            'product' => $prod]
            ]);
          }
          $prod = product::where('id', '=', 1)->first();

          return response()->json([
             "result" => ['success' => true], "data" =>
             ['msg' => "It looks like you have won a \"" .
            $prod->discription . "\"\nReclaim it on your next order 🎁", 'data' => $offer,
              'product' => $prod]]);

        } else {

          return response()->json(["result" => ['success' => false]]);
          //return response()->json(['unavailable'=>'User does not have enough points','code'=>"2000"]);
        }
      } else {

        return response()->json(["result" => ['success' => false]]);
        //return response()->json(['error '=>'Un Authorized User','code'=>"403"]);
      }
    } catch (\Illuminate\Database\QueryException $e) {
      
      return response()->json(["result" => ['success' => false]]);
      //return response()->json(['error' => "Exception", 'code'=>'500']);
    }
    return response()->json(["result" => ['success' => false]]);
    //return response()->json(['error'=>'Incorrect Email Password ','email'=>$email,'code'=>'403']);
  }
}
