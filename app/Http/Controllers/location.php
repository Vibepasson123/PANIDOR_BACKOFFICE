<?php

namespace App\Http\Controllers;
use App\Mpos;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class location extends Controller
{
     public function getLocation($MPOS_iD)
     {
         $M_id = $MPOS_id;  

          $loc=Mpos::where(['mpose_id','=',$M_id],['created_at','==',Carbon::today()])->get();

       return response()->json($loc);
     }

   
     public function street()
     {

      $lat="39.7572630";
      $lng="-8.7893010";
      


      $client= new client();
     // https://roads.googleapis.com/v1/nearestRoads?parameters&key=YOUR_API_KEY
     // $response = $client->request('GET','http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false'
    /*  $response = $client->request('GET',' https://roads.googleapis.com/v1/nearestRoads?'.$lat,$lang. "key"= "AIzaSyAUs7NdQunnNrZC8faGghf5ikSkMNXCdbw"
           
          ); */

          $street = $response->getBody();
          $test = json_decode($street);

           dd($test);

     
     }
}
