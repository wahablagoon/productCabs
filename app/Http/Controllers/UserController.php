<?php

namespace App\Http\Controllers;

use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	public function rider_signup(Request $request )
	{
		
		if(check_rider_email($request->email))
		{
			$myArray = ['status'=>'fail','reason'=>'Email already exists'];
			return response()->json(array($myArray));
		}
		elseif(check_rider_mobile($request->mobile,$request->countrycode))
		{
			$myArray = ['status'=>'fail','reason'=>'Mobile Number already exists'];
			return response()->json(array($myArray));
		}
		else
		{
			$data['firstname']=urldecode($request->firstname);
			$data['lastname']=urldecode($request->lastname);	
			$data['email']=$request->email;
			$data['phone'] =$request->mobile;
			$data['city'] =$request->city;
			$data['password'] =md5($request->password);
			$data['countrycode'] =$request->countrycode;
			$data['role']='1';
			$data['wallet']=0;
			$data['status']=1; //0 for not approved by admin // 1 approved
			$data['created']=time();
			$data['created_by']="user";

			//print_r($data);exit;
			$id=DB::table('member')->insertGetId($data);
			$myArray['status']='Success';				
			$myArray['userid'] = $id;
			$myArray['first_name']=$data['firstname'];
			$myArray['last_name']=$data['lastname'];
			$myArray['email']=$data['email'];
			$myArray['mobile']=$data['phone'];
			$myArray['country_code']=$data['countrycode'];
			return response()->json(array($myArray));
		}
	}
	
	public function rider_google_signup(Request $request )
	{
		if(check_rider_google($request->google_id))
		{
			$users = DB::table('member')->where('role',1)->where('google_id',$request->google_id);
			foreach ($users->get() as $user) 
			{
		 	 	$myArray['status']='Success';				
				$myArray['userid'] = $user->id;
				$myArray['first_name']=$user->firstname;
				$myArray['last_name']=$user->lastname;
				$myArray['email']=$user->email;
				$myArray['mobile']=$user->phone;
				$myArray['country_code']=$user->countrycode;
				$myArray['profile_pic']=$user->profile;				
				return response()->json(array($myArray));
			}
		}
		elseif(check_rider_email($request->email))
		{
			$myArray = ['status'=>'fail','reason'=>'Email already exists'];
			return response()->json(array($myArray));
		}
		elseif(check_rider_mobile($request->mobile,$request->countrycode))
		{
			$myArray = ['status'=>'fail','reason'=>'Mobile Number already exists'];
			return response()->json(array($myArray));
		}
		else
		{
			$data['firstname']=urldecode($request->firstname);
			$data['lastname']=urldecode($request->lastname);	
			$data['email']=$request->email;
			$data['phone'] =$request->mobile;
			$data['city'] =$request->city;
			$data['password'] =null;
			$data['countrycode']=$request->countrycode;
			$data['role']='1';
			$data['wallet']=0;
			$data['status']=1; //0 for not approved by admin // 1 approved
			$data['created']=time();
			$data['created_by']="user";
			$data['password']=null;
			$data['google_id']=$request->google_id;
			//print_r($data);exit;
			$id=DB::table('member')->insertGetId($data);
			$myArray['status']='Success';				
			$myArray['userid'] = $id;
			$myArray['first_name']=$data['firstname'];
			$myArray['last_name']=$data['lastname'];
			$myArray['email']=$data['email'];
			$myArray['mobile']=$data['phone'];
			$myArray['country_code']=$data['countrycode'];
			$myArray['profile_pic']="";
			return response()->json(array($myArray));
		}
	}
	
	public function rider_fbsignup(Request $request )
	{
		if(check_rider_facebook($request->fb_id))
		{
			$users = DB::table('member')->where('role',1)->where('facebook_id',$request->fb_id);
			foreach ($users->get() as $user) 
			{
		 	 	$myArray['status']='Success';				
				$myArray['userid'] = $user->id;
				$myArray['first_name']=$user->firstname;
				$myArray['last_name']=$user->lastname;
				$myArray['email']=$user->email;
				$myArray['mobile']=$user->phone;
				$myArray['country_code']=$user->countrycode;
				$myArray['profile_pic']=$user->profile;				
				return response()->json(array($myArray));
			}
		}
		elseif(check_rider_email($request->email))
		{
			$myArray = ['status'=>'fail','reason'=>'Email already exists'];
			return response()->json(array($myArray));
		}
		elseif(check_rider_mobile($request->mobile,$request->countrycode))
		{
			$myArray = ['status'=>'fail','reason'=>'Mobile Number already exists'];
			return response()->json(array($myArray));
		}
		else
		{
			$data['firstname']=urldecode($request->firstname);
			$data['lastname']=urldecode($request->lastname);	
			$data['email']=$request->email;
			$data['phone'] =$request->mobile;
			$data['city'] =$request->city;
			$data['password'] =null;
			$data['countrycode'] =$request->countrycode;
			$data['role']='1';
			$data['wallet']=0;
			$data['status']=1; //0 for not approved by admin // 1 approved
			$data['created']=time();
			$data['created_by']="user";
			$data['password']=null;
			$data['facebook_id']=$request->fb_id;
			$data['profile']="http://graph.facebook.com/".$request->fb_id."/picture?type=large";
			//print_r($data);exit;
			$id=DB::table('member')->insertGetId($data);
			$myArray['status']='Success';				
			$myArray['userid'] = $id;
			$myArray['first_name']=$data['firstname'];
			$myArray['last_name']=$data['lastname'];
			$myArray['email']=$data['email'];
			$myArray['mobile']=$data['phone'];
			$myArray['country_code']=$data['countrycode'];
			$myArray['profile_pic']=$data['profile'];
			return response()->json(array($myArray));
		}
	}


	public function rider_signin(Request $request)
	{
		if(check_rider_email($request->email))
		{
			$users = DB::table('member')->where('role',1)->where('email',$request->email)->where('password',md5($request->password));
			if($users->count()>0)
			{			
				foreach ($users->get() as $user) 
				{
			 	 	$myArray['status']='Success';				
					$myArray['userid'] = $user->id;
					$myArray['first_name']=$user->firstname;
					$myArray['last_name']=$user->lastname;
					$myArray['email']=$user->email;
					$myArray['mobile']=$user->phone;
					$myArray['country_code']=$user->countrycode;
					return response()->json(array($myArray));
				}
			}
			else
			{
				$myArray = ['status'=>'fail','reason'=>'Invalid password'];
				return response()->json(array($myArray));			
			}	
		}
		else
		{
			$myArray = ['status'=>'fail','reason'=>'Invalid Mail id'];
			return response()->json(array($myArray));
		}
	}


}