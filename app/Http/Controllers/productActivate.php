<?php

namespace App\Http\Controllers;

use \App\Mpos;
use Sentinel;
use Activation;
use \App\clientUser;
use \App\User;
use Carbon;
use \App\voucher;
use \App\og_client;
use Hash;
use Validator;
use GuzzleHttp\Client;
use \App\Mlocation;
use \App\product;
use \App\product_limit;
use \App\invitation;
use Illuminate\Http\Request;


class productActivate extends Controller
{
    public function prodcutActivation($id)
    {

        $mpos = Mpos::all();

        foreach ($mpos as $mposlist) {
            $url = $mposlist->OGURL;
            if (!empty($url) && strlen($url) > 0 && $url[(strlen($url) - 1)] == '/') {
                $url = substr($url, 0, (strlen($url) - 1));
            }
            $username = $mposlist->OGapiUser;
            $password = $mposlist->OGapipass;


            $client = new Client();
            try {
                $request = $client->request('GET', $url . '/api/tables/vats', [
                    'auth' => [$username, $password],
                ]);
                $status_code = $request->getStatusCode();
                if ($status_code == 200) {
                    $requestStatus = $request->getBody();
                    $res = json_decode($requestStatus);
                    if (!empty($res->vats)) {
                        $vats = $res->vats;
                        $vats_a = array_values((array) $vats);
                        $mposlist->vats = $vats_a;
                    }
                }
            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                //Catch errors
                $e->getResponse()->getStatusCode();
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // This will catch all 400 level errors.
                $e->getResponse()->getStatusCode();
            }
        }

        $product_id = $id;

        return view('products.activateProduct', compact('mpos', 'product_id'));
    }





    public function updateActivate(Request $request)
    {
        $data = $request->all();

        $vat   = $data['vat'];

        $price = $data['price'];

        $mpos = $data['mpos_id'];

        $product_id = $data['product_id'];

        $product_limit = $data['limit'];

        $limit_time = $data['time'];

        if ($vat == "selectval") {

            $msg = "Please selct the vat";
            return response()->json([$msg]);
        } elseif ($price == "") {

            $msg2 = "Please select the price";
            return response()->json([$msg2]);
        }
        if ($product_limit == "") {
            $msg3 = "Please Select the product limit";
            return response()->json([$msg3]);
        }
        if ($limit_time == "") {
            $msg4 = "Please Select the Stock Refilling Time";
            return response()->json([$msg4]);
        }

        $article = product::where('id', '=', $product_id)->first();
        $codeartigo = $article['codArtigo'];

        $description = $article['discription'];
        $shoort_description = $article['short_description'];
        $get_mpos = mpos::where('id', '=', $mpos)->first();

        if ($get_mpos == NULL) {
            $Msg = "MPOS NOT FOUND";
            return response()->json([$msg]);
        }

        $url = $get_mpos['OGURL'];
        $ogApiPass = $get_mpos['OGapipass'];
        $ogUser = $get_mpos['OGapiUser'];

        if (!empty($url) && strlen($url) > 0 && $url[(strlen($url) - 1)] == '/') {

            $url = substr($url, 0, (strlen($url) - 1));
        }


        $check_codeartigo  = new Client();

        $find_codeartigo = $check_codeartigo->request('GET', $url . '/api/stocks/articles/' . $codeartigo, [
            
            'auth' => [$ogUser, $ogApiPass],

        ]);

        $requestStatus = $find_codeartigo->getBody();

        $res = json_decode($requestStatus);

        $status = $res->code;


        if ($status == 1000) {
            $msg = "Product Already Exsist";
            return response()->json([$msg]);
        } else {
            $vat_percentage = null;
            try {
                $getVat = new Client();
                $response = $getVat->request('GET', $url . '/api/tables/vats?filter[id]=' . $vat, [
                    'auth' => [$ogUser, $ogApiPass],
                ]);
                $body = $response->getBody();
                $res = json_decode($body);
                //var_dump($body);
                if ($res->code === 1000) {
                    foreach ($res->vats as $key => $value) {
                        if ($value->id == $vat) {
                            $vat_percentage = $value->value;
                            break;
                        }
                    }
                }
            } catch (\GuzzleHttp\Exception\ConnectException $e) {
                die();
            }

            if ($vat_percentage === null) {
                die();
            }
            $vat_percentage = ($vat_percentage / 100.0) + 1;

            try {

                $creatProduct = new Client();

                $request_new_product = $creatProduct->request('POST', $url . '/api/stocks/articles', [
                    'auth' => [$ogUser, $ogApiPass],
                    'form_params' =>
                    [
                        'id' => $codeartigo,
                        'description' => $description,
                        'articletype' =>  "N",
                        'vatid' => $vat,
                        'unit' =>  "UN",
                        'short_description' => $shoort_description,
                        'sellingprice' => $price / $vat_percentage,
                    ],
                ]);

                $product_created = $request_new_product->getBody();
                $product_created_result = json_decode($product_created);

                $article->vatid = $vat;
                $article->price = $price;
                $article->save();

                $productLimit = new product_limit;
                $productLimit->mpos_id = $mpos;
                $productLimit->product_id = $product_id;
                $productLimit->limit_time = $limit_time;
                $productLimit->limit = $product_limit;
                $productLimit->save();

                $article->productmpos()->attach($get_mpos);


                $message = "Product added to the MPOS";

                return response()->json([$message, $product_created_result]);
            } catch (\GuzzleHttp\Exception\ConnectException $e) {

                die();
            }
        }
    }
}
