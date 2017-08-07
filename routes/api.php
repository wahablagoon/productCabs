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


//Rider API's
Route::get('rider/signup', 'UserController@signup');


//Drivers API's

Route::get('driver/updateOnlineStatus/{userid}/{online_status}', 'UserController@updateOnlineStatus');

//common API's User controller
Route::get('signin', 'UserController@signin');
Route::get('emailExist', 'UserController@email_exist');
Route::get('mobileExist', 'UserController@mobile_exist');

Route::get('updateLocation', 'UserController@updateLocation');
Route::get('sentOTP', 'UserController@sendOTP');
Route::get('updateOTP', 'UserController@updateOTP');
Route::get('sendmail','UserController@sendEmailReminder');


//Request API's
Route::get('firebase','RequestController@updatereq');
Route::get('requests/setRequest', 'RequestController@setRequest');
Route::get('requests/getRequest', 'RequestController@getRequest');
Route::get('requests/updateRequest/{request_id}/{driver_id}/{request_status}', 'RequestController@updateRequest');


//Admin Controller
Route::get('getCategory/', 'AdminController@getCategory');