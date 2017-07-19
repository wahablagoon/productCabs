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
Route::get('/', function()
{
	return View::make('comming_soon');	
});

Route::get('mailsample/{page}', function(Request $request){
	$data['email']="dfs";
	$data['reset_url']="dfs";
	$data['name']="praveen";
	return View::make('emails/'.$request->page,$data);
});

Route::get('admin', function()
{
	if(is_loggedin())
	{
		return View::make('home');	
	}
	else
	{
		return View::make('auth/login');		
	}	
	
});
Route::get('admin/login', function()
{
	if(is_loggedin())
	{
		return View::make('home');	
	}
	else
	{
		return View::make('auth/login');		
	}	
});

Route::post('checklogin', function(Request $request)
{	
	$users = DB::table('member')->where('role',3)->where('email',$request->username);
	if($users->count()>0 && $users->first()->password==$request->password)
	{
		$userdata['trippy_username']=$request->username;
		$userdata['trippy_id']=$users->first()->id;
		$userdata['trippy_loggedin']=true;
		session($userdata);
		echo  "success";
	}
	else
	{
		echo "fail";
	}
});

Route::post('resetadmin', function(Request $request)
{	
	$users = DB::table('member')->where('role',3)->where('email',$request->email);
	if($users->count()>0)
	{
		$data['email']=$request->email;
		$data['reset_url']=url('reset_password/'.$users->first()->id.'/'.time());
		Mail::send('emails.remainder', ['data' => $data], function ($m) use ($data) {
		    $m->from('praveenak.bsc@gmail.com','trippy');	
		    $m->to($request->email, $users->first()->firstname)->subject('trippy - Reset your password');
		});
		echo  "success";
	}
	else
	{
		echo "fail";
	}
});



Route::get('logout', function(Request $request)
{	
	$userdata['trippy_loggedin']=false;
	session($userdata);
	return redirect('admin/login');
});

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
