<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::POST('/Mposlocation','mposApi@mposLocation');
Route::POST('/Products','mposApi@getproduct');
Route::POST('/createUser','mposApi@createApiUser');
Route::POST('/createUserFB','mposApi@createFBUser');
Route::POST('/update_user ','mposApi@update_cleint');
Route::POST('/clientDetails ','mposApi@getClientDetails');
Route::POST('/getMposEmail ','mposApi@getMposEmail');
Route::POST('/getCountries','orderApi@getCountries');

Route::POST('/order','orderApi@Clientorder');
Route::POST('/orderMin','orderApi@ClientOrderMin');
Route::POST('/login','mposApi@login');
Route::POST('/check','mposApi@checkhash');
Route::POST('/checkOrder','orderApi@checkorder');
Route::POST('/clientUpdate','manageClient@updateclient');
Route::POST('/getClient','manageClient@getClient');
Route::POST('/comments','manageClient@clientReviews');
Route::POST('/getReviews','manageClient@getReviews');
Route::POST('/invitation','manageinvitationAPI@invitation');
Route::POST('/invitationInfo','manageinvitationAPI@RequestInvitation');
Route::POST('/create_og','orderApi@create_ogclient');
Route::POST('/updateLocation','posM@updateMpos_location');
//Route::GET('/ogtest','productmangement@sync');
Route::POST('/points','manageinvitationAPI@getPoints');
Route::POST('/activeCamp','campApi@getCampaing');





Route::GET('/street','test@getStreet');

