<?php


namespace App\Http\Controllers;

use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use View;
use File;
use App\Models\member;
use App\Models\SiteSettings;
use App\Models\CountryCode;
use App\Models\Api;

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
		$users = member::where('role',3);
		if($users->count()>0 && $request->username=="admin" &&$users->first()->password==$request->password)
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

	public function view_api()
	{
		$data=Api::all();
		foreach ($data as $key => $value) {
			$api[$value->code]=$value->value;
		}
		return View::make('layouts/admin/view_api',$api);		
	}

	public function resetadmin(Request $request)
	{
		$users = member::where('role',3)->where('email',$request->email);
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

	public function api_settings(Request $request)
	{
		$data=Api::all();
		foreach ($data as $key => $value) {
			if($request[$value->code]!="")
			{
				$update_date['value']=$request[$value->code];
			}
			else
			{
				$update_date['value']="";	
			}
			
			Api::where('code',$value->code)->update($update_date);
		}
		flash('Api Settings Updated Successfully')->success()->important();
		return redirect('admin/settings/api');
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

	public function view_user()
	{
		return View::make('layouts/admin/view_user');		
	}

	public function view_provider()
	{
		return View::make('layouts/admin/view_provider');		
	}
	public function view_create_user()
	{
		$cc=CountryCode::all();
		foreach($cc as $c)
		{
			$country_code[]=$c;
		}
		$data['country_code']=$country_code;
		return View::make('layouts/admin/view_user_create',$data);			
	}

	public function view_create_provider()
	{
		$cc=CountryCode::all();
		foreach($cc as $c)
		{
			$country_code[]=$c;
		}
		$data['country_code']=$country_code;
		return View::make('layouts/admin/view_driver_create',$data);			
	}

	public function uploadlogo(Request $request)
	{
		$file = request()->file('file-upload');
		$ext=$file->guessClientExtension();
		$name=$file->getClientOriginalName();
		$file->storeAs('images/',$name);
		$oldfile=site_settings()->site_logo;
		$filename = 'storage/app/images/'.$oldfile;
		File::delete($filename);
		$data['site_logo']=$name;
		$update=SiteSettings::where('id',1)->update($data);
		flash('Site Logo Updated Successfully')->success()->important();
		return redirect('admin/settings');
	}
	public function uploadicon(Request $request)
	{
		$file = request()->file('file-upload');
		$ext=$file->guessClientExtension();
		$name=$file->getClientOriginalName();
		$file->storeAs('images/',$name);
		$oldfile=site_settings()->site_icon;
		$filename = 'storage/app/images/'.$oldfile;
		File::delete($filename);
		$data['site_icon']=$name;
		$update=SiteSettings::where('id',1)->update($data);
		flash('Site Icon Updated Successfully')->success()->important();
		return redirect('admin/settings');
	}

	public function set_sitecolor(Request $request)
	{
		$data['site_theme_color']=$request->color;
		$update=SiteSettings::where('id',1)->update($data);
		flash('Site Color Updated Successfully')->success()->important();
		echo "success";
	}

	public function site_settings(Request $request)
	{

		SiteSettings::where('id',1)->update($request->all());
		flash('Site Settings Updated Successfully')->success()->important();
		return redirect('admin/settings');

	}

	public function rider_signup(Request $request)
	{
		unset($request['_token']);
		$rider = member::create($request->all());
		flash('Rider Added Successfully')->success()->important();
		return redirect('admin/passengers');
	}

	public function provider_signup(Request $request)
	{
		unset($request['_token']);
		$rider = member::create($request->all());
		flash('Provider Added Successfully')->success()->important();
		return redirect('admin/drivers');
	}

}
