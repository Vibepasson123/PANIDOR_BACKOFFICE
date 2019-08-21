<?php

namespace App\Http\Controllers;
use \App\Mpos;
use Sentinel;
use GuzzleHttp\Client;
use Activation;
use \App\clientUser;
use \App\User; 
use Carbon\Carbon;
use \App\Mlocation;
use \App\product;
use \App\order;
use \App\invitation ;
use \App\og_client;
use Illuminate\Http\Request;

class test extends Controller
{
    
public function getStreet()
{

    $lat="40.714224";
    $lon="73.961452";




    $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&sensor=false";


        $data = @file_get_contents($url);

       $jsondata = json_decode($data,true);

         if (!check_status($jsondata))   
         
         
         
         return array();
         $address = array(
            'country' => google_getCountry($jsondata),
            'province' => google_getProvince($jsondata),
            'city' => google_getCity($jsondata),
            'street' => google_getStreet($jsondata),
            'postal_code' => google_getPostalCode($jsondata),
            'country_code' => google_getCountryCode($jsondata),
            'formatted_address' => google_getAddress($jsondata),
        );
        


             return response($address, $jsondata );

        
        }
        
        /* 
        * Check if the json data from Google Geo is valid 
        */
        
        

/* 
    $client = new Client();

    $response = $client->request('GET','http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&sensor=false');

     */




}




function check_status($jsondata) {
    if ($jsondata["status"] == "OK") return true;
    return false;
}

function google_getCountry($jsondata) {
return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"]);
}
function google_getProvince($jsondata) {
return Find_Long_Name_Given_Type("administrative_area_level_1", $jsondata["results"][0]["address_components"], true);
}
function google_getCity($jsondata) {
return Find_Long_Name_Given_Type("locality", $jsondata["results"][0]["address_components"]);
}
function google_getStreet($jsondata) {
return Find_Long_Name_Given_Type("street_number", $jsondata["results"][0]["address_components"]) . ' ' . Find_Long_Name_Given_Type("route", $jsondata["results"][0]["address_components"]);
}
function google_getPostalCode($jsondata) {
return Find_Long_Name_Given_Type("postal_code", $jsondata["results"][0]["address_components"]);
}
function google_getCountryCode($jsondata) {
return Find_Long_Name_Given_Type("country", $jsondata["results"][0]["address_components"], true);
}
function google_getAddress($jsondata) {
return $jsondata["results"][0]["formatted_address"];
}

/*
* Searching in Google Geo json, return the long name given the type. 
* (If short_name is true, return short name)
*/

function Find_Long_Name_Given_Type($type, $array, $short_name = false) {
foreach( $array as $value) {
if (in_array($type, $value["types"])) {
    if ($short_name)    
        return $value["short_name"];
    return $value["long_name"];
}
}




}
