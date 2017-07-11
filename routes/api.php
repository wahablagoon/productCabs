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



//Drivers API's
Route::get('driver/signup/{firstname}/{lastname}/{mobile}/{countrycode}/{password}/{city}/{email}/{profile_pic}/{license}/{insurance}/{category}', 'DriverController@driver_signup');
Route::get('driver/fb_signup/{firstname}/{lastname}/{mobile}/{countrycode}/{city}/{email}/{fb_id}/{profile_pic}/{license}/{insurance}/{category}', 'DriverController@driver_fbsignup');
Route::get('driver/google_signup/{firstname}/{lastname}/{mobile}/{countrycode}/{city}/{email}/{google_id}/{profile_pic}/{license}/{insurance}/{category}', 'DriverController@driver_google_signup');
Route::get('driver/signin/{email}/{password}', 'DriverController@driver_signin');


