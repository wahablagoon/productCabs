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

Route::get('user', 'MonoController@index');

//Rider API's
Route::get('rider/signup/{firstname}/{lastname}/{mobile}/{countrycode}/{password}/{city}/{email}', 'UserController@rider_signup');
Route::get('rider/fb_signup/{firstname}/{lastname}/{mobile}/{countrycode}/{city}/{email}/{fb_id}', 'UserController@rider_fbsignup');
Route::get('rider/google_signup/{firstname}/{lastname}/{mobile}/{countrycode}/{city}/{email}/{google_id}', 'UserController@rider_google_signup');
Route::get('rider/signin/{email}/{password}', 'UserController@rider_signin');
Route::get('rider/emailExist/{email}', 'UserController@rider_email_exist');
Route::get('rider/mobileExist/{mobile}/{countrycode}', 'UserController@rider_mobile_exist');
Route::get('rider/fbExist/{fbid}', 'UserController@rider_fb_exist');
Route::get('rider/googleExist/{googleid}', 'UserController@rider_google_exist');
Route::get('rider/editProfile/{userid}', 'UserController@edit_profile');
Route::get('rider/updateProfile/{userid}/{firstname}/{lastname}/{mobile}/{countrycode}/{password}/{city}/{profile_pic}/{email}', 'UserController@update_profile');



//Drivers API's
Route::get('driver/signup/{firstname}/{lastname}/{mobile}/{countrycode}/{password}/{city}/{email}/{profile_pic}/{license}/{insurance}/{category}', 'DriverController@driver_signup');
Route::get('driver/fb_signup/{firstname}/{lastname}/{mobile}/{countrycode}/{city}/{email}/{fb_id}/{profile_pic}/{license}/{insurance}/{category}', 'DriverController@driver_fbsignup');
Route::get('driver/google_signup/{firstname}/{lastname}/{mobile}/{countrycode}/{city}/{email}/{google_id}/{profile_pic}/{license}/{insurance}/{category}', 'DriverController@driver_google_signup');
Route::get('driver/signin/{email}/{password}', 'DriverController@driver_signin');
Route::get('driver/updateOnlineStatus/{userid}/{online_status}', 'DriverController@updateOnlineStatus');
Route::get('driver/emailExist/{email}', 'DriverController@driver_email_exist');
Route::get('driver/mobileExist/{mobile}/{countrycode}', 'DriverController@driver_mobile_exist');
Route::get('driver/fbExist/{fbid}', 'DriverController@driver_fb_exist');
Route::get('driver/googleExist/{googleid}', 'DriverController@driver_google_exist');
Route::get('driver/editProfile/{userid}', 'DriverController@edit_profile');
Route::get('driver/updateProfile/{userid}/{firstname}/{lastname}/{mobile}/{countrycode}/{password}/{city}/{email}/{profile_pic}/{license}/{insurance}/{category}', 'DriverController@update_profile');


//common API's
Route::get('updateLocation/{userid}/{lat}/{long}', 'MonoController@updateLocation');
Route::get('getCategory/', 'MonoController@getCategory');



