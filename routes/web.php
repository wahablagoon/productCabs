<?php
use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('upload_image/{userid}', function (Request $request) {
	$file = request()->file('upload_image');
	$ext=$file->guessClientExtension();
	$name=$file->getClientOriginalName();
	$userid=$request->userid;
	$file->storeAs('images/'.$userid,$name);

	//echo $url = Storage::url($userid."/".$name);
	$myArray['status']="Success";
	$myArray['image_name']=$name;
	$myArray['message']="";
	$myArray['image_url']= url('/')."/storage/app/images/".$userid."/".$name;
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