<?php

namespace App\Http\Controllers;

use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Models\Firebase;
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
			$data['password'] =$request->password;
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
			$users = DB::table('member')->where('role',1)->where('email',$request->email)->where('password',$request->password);
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
				}
				return response()->json(array($myArray));
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

	public function rider_email_exist(Request $request)
	{
		$email=$request->email;
		$check=check_rider_email($email);
		if($check)
		{
			$users = DB::table('member')->where('role',1)->where('email',$email);
			foreach ($users->get() as $user) 
			{
		 	 	$myArray['status']='Success';				
				$myArray['userid'] = $user->id;
				$myArray['first_name']=$user->firstname;
				$myArray['last_name']=$user->lastname;
				$myArray['email']=$user->email;
				$myArray['mobile']=$user->phone;
				$myArray['country_code']=$user->countrycode;
			}
			return response()->json(array($myArray));

		}
		else
		{
			$myArray = ['status'=>'fail','reason'=>'New User'];
			return response()->json(array($myArray));	
		}
	}

	public function rider_mobile_exist(Request $request)
	{
		$mobile=$request->mobile;
		$check=check_rider_mobile($mobile,$request->countrycode);
		if($check)
		{
			$users = DB::table('member')->where('role',1)->where('phone',$mobile);
			foreach ($users->get() as $user) 
			{
		 	 	$myArray['status']='Success';				
				$myArray['userid'] = $user->id;
				$myArray['first_name']=$user->firstname;
				$myArray['last_name']=$user->lastname;
				$myArray['email']=$user->email;
				$myArray['mobile']=$user->phone;
				$myArray['country_code']=$user->countrycode;
			}
			return response()->json(array($myArray));

		}
		else
		{
			$myArray = ['status'=>'fail','reason'=>'New User'];
			return response()->json(array($myArray));	
		}
	}

	public function rider_fb_exist(Request $request)
	{
		$fbid=$request->fbid;
		$check=check_rider_facebook($fbid);
		if($check)
		{
			$users = DB::table('member')->where('role',1)->where('facebook_id',$fbid);
			foreach ($users->get() as $user) 
			{
		 	 	$myArray['status']='Success';				
				$myArray['userid'] = $user->id;
				$myArray['first_name']=$user->firstname;
				$myArray['last_name']=$user->lastname;
				$myArray['email']=$user->email;
				$myArray['mobile']=$user->phone;
				$myArray['country_code']=$user->countrycode;
			}
			return response()->json(array($myArray));

		}
		else
		{
			$myArray = ['status'=>'fail','reason'=>'New User'];
			return response()->json(array($myArray));	
		}
	}
	
	public function rider_google_exist(Request $request)
	{
		$googleid=$request->googleid;
		$check=check_rider_google($googleid);
		if($check)
		{
			$users = DB::table('member')->where('role',1)->where('google_id',$googleid);
			foreach ($users->get() as $user) 
			{
		 	 	$myArray['status']='Success';				
				$myArray['userid'] = $user->id;
				$myArray['first_name']=$user->firstname;
				$myArray['last_name']=$user->lastname;
				$myArray['email']=$user->email;
				$myArray['mobile']=$user->phone;
				$myArray['country_code']=$user->countrycode;
			}
			return response()->json(array($myArray));

		}
		else
		{
			$myArray = ['status'=>'fail','reason'=>'New User'];
			return response()->json(array($myArray));	
		}
	}

	public function edit_profile(Request $request)
	{
		$userid=$request->userid;
		$check=check_rider_id($userid);
		if($check)
		{
			$users = DB::table('member')->where('role',1)->where('id',$userid);
			foreach ($users->get() as $user) 
			{
		 	 	$myArray['status']='Success';				
				$myArray['userid'] = $user->id;
				$myArray['first_name']=$user->firstname;
				$myArray['last_name']=$user->lastname;
				$myArray['email']=$user->email;
				$myArray['city']=$user->city;
				$myArray['password']=$user->password;
				$myArray['mobile']=$user->phone;
				$myArray['country_code']=$user->countrycode;
				$myArray['profile_pic']=$user->profile;
			}
			return response()->json(array($myArray));

		}
		else
		{
			$myArray = ['status'=>'fail','reason'=>'New User'];
			return response()->json(array($myArray));	
		}	
	}


	public function update_profile(Request $request )
	{
		
		if(check_rider_email($request->email,$request->userid))
		{
			$myArray = ['status'=>'fail','reason'=>'Email already exists'];
			return response()->json(array($myArray));
		}
		elseif(check_rider_mobile($request->mobile,$request->countrycode,$request->userid))
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
			$data['password'] =$request->password;
			$data['countrycode'] =$request->countrycode;
			$data['role']='1';
			//$data['wallet']=0;
			//$data['status']=1; //0 for not approved by admin // 1 approved
			$data['modified']=time();
			$data['modified_by']="user";
			$data['profile']=$request->profile_pic;
			//print_r($data);exit;
			DB::table('member')->where('id',$request->userid)->update($data);
			$myArray['status']='Success';				
			$myArray['userid'] = $request->userid;
			$myArray['first_name']=$data['firstname'];
			$myArray['last_name']=$data['lastname'];
			$myArray['password']=$data['password'];
			$myArray['email']=$data['email'];
			$myArray['city']=$data['city'];
			$myArray['mobile']=$data['phone'];
			$myArray['country_code']=$data['countrycode'];
			$myArray['profile_pic']=$data['profile'];
			return response()->json(array($myArray));
		}
	}

	public function firebase_connect()
	{
		$firebase = new Firebase();
		$path="/firebase/drivers/1506993752/";
		$data['online_status']=1;
		$data['username']="al";
		$res=$firebase->setdata($path,$data);
		print_r($res);

	}

}