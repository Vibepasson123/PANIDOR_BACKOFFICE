<?php

namespace App\Http\Controllers;

use App\clientUser;
use App\reviews;
use Illuminate\Http\Request;

class manageClient extends Controller
{

  public function updateclient(Request $request)
  {
    try {

      $email = $request->input('email');

      $hash = $request->input('hash');

      if ($user = clientUser::where('email', '=', $email)->where('hash', '=', $hash)->first()) {

        $id = $user->id;

        $upclient = clientUser::find($id);

        $upclient->first_name = $request->input('first_name');
        $upclient->last_name = $request->input('last_name');
        $upclient->mobile = $request->input('mobile');
        $upclient->address = $request->input('address');
        $upclient->save();

        return response()->json(['status' => 'success', 'Client' => 'Udated Successfully']);

      } else
        return response()->json(['status' => 'failed']);

    } catch (\Illuminate\Database\QueryException $e) { 

    }
    return response()->json(['error' => $e]);
  }

  public function getClient(Request $request)
  {

    try {
      $email = $request->input('email');
      $hash = $request->input('hash');

      if ($user = clientUser::where('email', '=', $email)->where('hash', '=', $hash)->first()) {

        return response()->json(['result' => ['success' => true], 'data' => ["user_data" => $user]]);

      } else

        return response()->json(['result' => ['success' => false]]);

    } catch (\Illuminate\Database\QueryException $e) {

      return response()->json(['status' => 'failed = user not found']);

      return response()->json(['result' => ['success' => false]]);
    }
  }

  public function clientReviews(Request $request)
  {

    try {
      $email = $request->input('email');
      $hash = $request->input('hash');
      
      if ($user = clientUser::where('email', '=', $email)->where('hash', '=', $hash)->first()) {

        $get_id = $user->id;
        sleep(1);
        $rev = new reviews;
        $rev->client_id = $get_id;
        $rev->mpos_id = $request->input('mpos_id');
        $rev->rate = $request->input('rate');
        $rev->email = $email;
        $rev->comments = $request->input('comment');
        $rev->save();

        return response()->json(['status' => 'SUCCESS REVIEW ADDED']);

      } else

        return response()->json(['status' => 'failed']);

    } catch (\Illuminate\Database\QueryException $e) {

      return response()->json(['error' => $e]);
    }
  }

  public function getReviews(Request $request)
  {
    try {
      $email = $request->input('email');
      $hash = $request->input('hash');

      if ($user = clientUser::where('email', '=', $email)->where('hash', '=', $hash)->first()) {

        sleep(1);

        $reviewlist = reviews::all();

        return response()->json(["result" => ['success' => true], "data" => ['reviews' => $reviewlist]]);

      } else {
        return response()->json(["result" => ['success' => false]]);
      }
    } catch (\Illuminate\Database\QueryException $e) {

      return response()->json(["result" => ['success' => false]]);
    }
  }
}
