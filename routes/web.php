<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('users.login');

});



Route::get('/register',function (){

return view('home.home');

});







/* Route::get('/home', function () {
    return view('Layout.mainlayout');

}); */

Route::get('/reg','registerUser@authenticateUserRegister');
Route::get('/','registerUser@checkUser');
Route::get('/login','registerUser@checkUser');
Route::get('/home','manageDashboard@getHome');
Route::get('/Products','productControl@getProduct');
Route::get('/Poslist','listM@getlist');
Route::get('/Vmpos/{id}','posM@posView');    
Route::POST('/addmpos','posM@add_MPOS');
Route::POST('/RegUser','managesuer@createuser');
Route::POST('/Auth','login@postlogin');
Route::get('/logout','login@logout');
Route::get('/staticstic','stacM@staticstic');
Route::get('/order/{id}','clientOrder@getOrder');

Route::get('/userdetails','userdetails@getall_user');







/* <=====================updates==============> */
Route::get('/update/{id}','posM@upView');
Route::POST('updateD','posM@updateMpos');
/* <=====================Campaing Management==============> */
Route::get('/camp/{id}','campaing@Tcamp' );
Route::get('/getCamp','campaing@getcamp');
Route::POST('/setcamp','campaing@setCamp');
Route::POST('/adcampp','campaing@addcampaign');
Route::get('/orderdel/{oderid}','clientOrder@CdetailOrder');
Route::POST('/deactcamp','campaing@deactCamp');
Route::POST('/actcamp','campaing@actCamp');
/* <=====================MPOS LOCATION Management==============> */
Route::get('/place','location@street');
Route::get('/updatelocation/{id}','posM@updateloc');
Route::POST('/AddNewlocation','posM@locatonUpdate');
/* <=====================PRODUCT Management==============> */
Route::POST('/AddProduct','productmangement@addProduct_local');
//Route::get('/sync','productmangement@sync');
Route::get('/selectProduct/{id}','productmangement@getproduct');
Route::POST('/updateProduct','productmangement@updateproduct');
Route::get('/activateProduct/{id}','productActivate@prodcutActivation');
Route::POST('/productAcitvate','productActivate@updateActivate');
/* <=====================IMAGE Management==============> */
Route::POST('/uploadpic','mposImage@storeImage');
Route::POST('/deletepic','mposImage@deleteImage');
Route::POST('/productpic_upload','mposImage@productImage');
Route::POST('/productDetaisImage','productControl@productDeatilsImage');
Route::POST('/imageDetails','productControl@allImageDetails');
/* <=====================PRODUCT LIMITING==============> */
Route::GET('/product_limit/{id}','manage_product_limit@Mpos_product_limit');