<?php
use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
Route::get('sendsms/{to}/{message}', function (Request $request){
	$result=sendSms('+'.$request->to,$request->message);
	if($result->status!="queued")
	{
	$myArray['status']= $result->status;
	$myArray['message']= $result->message;
	return response()->json(array($myArray));
	}
	else
	{
	$myArray['status']= $result->status;
	$myArray['message']= "success";
	return response()->json(array($myArray));
	}
});


Route::post('upload_image', function (Request $request) {
	$file = request()->file('upload_image');
	$ext=$file->guessClientExtension();
	$name=$file->getClientOriginalName();
	$file->storeAs('images/',$name);
	$myArray['status']="Success";
	$myArray['image_name']=$name;
	$myArray['message']="";
	$myArray['image_url']= url('/')."/storage/app/images/".$name;
	return response()->json(array($myArray));
});

Route::post('upload_document/{userid}', function (Request $request) {
	$file = request()->file('upload_document');
	$ext=$file->guessClientExtension();
	$name=$file->getClientOriginalName();
	$userid=$request->userid;
	$file->storeAs('documents/'.$userid,$name);

	//echo $url = Storage::url($userid."/".$name);
	$myArray['status']="Success";
	$myArray['image_name']=$name;
	$myArray['message']="";
	$myArray['image_url']= url('/')."/storage/app/documents/".$userid."/".$name;
	return response()->json(array($myArray));
});


Route::get('/','AdminController@comming_soon');
Route::get('admin','AdminController@index');
Route::get('admin/login','AdminController@index');
Route::get('logout','AdminController@logout');
Route::get('admin/settings','AdminController@view_settings');
Route::post('admin/upload_logo','AdminController@uploadlogo');
Route::post('admin/upload_icon','AdminController@uploadicon');
Route::post('admin/set_sitecolor','AdminController@set_sitecolor');
Route::post('admin/site_settings','AdminController@site_settings');
Route::post('checklogin','AdminController@checklogin');
Route::post('resetadmin','AdminController@resetadmin');
