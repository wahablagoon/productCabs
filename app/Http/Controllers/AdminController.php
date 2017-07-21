<?php


namespace App\Http\Controllers;

use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use View;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
	public function index()
	{
		if(is_loggedin())
		{
			return View::make('home');	
		}
		else
		{
			return View::make('auth/login');		
		}	

	}
    public function checklogin(Request $request)
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
	}

	public function comming_soon()
	{
		return View::make('comming_soon');	
	}

	public function resetadmin(Request $request)
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
	}

	public function logout()
	{
		$userdata['trippy_loggedin']=false;
		session($userdata);
		return redirect('admin/login');
	}

	public function view_settings()
	{
		return View::make('layouts/admin/view_settings');		
	}

}
