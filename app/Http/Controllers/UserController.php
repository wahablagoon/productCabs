<?php

namespace App\Http\Controllers;

use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Models\Firebase;
use App\Models\Twilio;
use App\User;

class UserController extends Controller
{
	public function signup(Request $request)
	{		
		if(check_email($request->role,$request->email,$request->own))
		{
			$myArray = ['status'=>'fail','reason'=>'Email already exists'];
			return response()->json(array($myArray));
			exit;
		}
		if(check_mobile($request->role,$request->phone,$request->countrycode,$request->own))
		{
			$myArray = ['status'=>'fail','reason'=>'Mobile Number already exists'];
			return response()->json(array($myArray));
			exit;
		}
		if($request->own!="0")
		{
			$userid=$request['own'];
			unset($request['own']);
			$user=User::where('id',$userid)->update($request->all());
			$id=$userid;
		}
		else
		{
			unset($request['own']);
			$user=User::create($request->all());
			$id=$user->id;
		}
		$myArray['status']='Success';				
		$myArray['userid'] = $id;
		return response()->json(array(array_merge($request->all(),$myArray)));
	}
	
	public function signin(Request $request)
	{
		$emailPattern = '/^\w{2,}@\w{2,}\.\w{2,4}$/'; 
		$mobilePattern ="/^[7-9][0-9]{9}$/"; 
		if(preg_match($emailPattern, $request->username))
		{
			if(check_email($request->role,$request->username))
			{
				$users = User::where('role',$request->role)->where('email',$request->username)->where('password',$request->password);
				if($users->count()>0)
				{			
					foreach ($users->get() as $user) 
					{}
					unset($user['created_at']);
					$user['status']='Success';
					return response()->json(array($user));
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
		elseif(preg_match($mobilePattern, $request->username))
		{
			if(check_mobile($request->role,$request->username,$request->countrycode))
			{
				$users = User::where('role',$request->role)->where('countrycode',$request->countrycode)->where('phone',$request->username)->where('password',$request->password);
				if($users->count()>0)
				{			
					foreach ($users->get() as $user) 
					{}
					unset($user['created_at']);
					$user['status']='Success';
					return response()->json(array($user));
				}
				else
				{
					$myArray = ['status'=>'fail','reason'=>'Invalid password'];
					return response()->json(array($myArray));			
				}	
			}
			else
			{
				$myArray = ['status'=>'fail','reason'=>'Invalid Phone number'];
				return response()->json(array($myArray));
			}
		}
		else 
		{
		    $myArray = ['status'=>'Fail','reason'=>'Invalid'];
			return response()->json(array($myArray));
		}
	}

	public function email_exist(Request $request)
	{		
		if(check_email($request->role,$request->email))
		{
			$users = User::where('role',$request->role)->where('email',$request->email);
			foreach ($users->get() as $user) 
			{}
			$user['status']='Success';
			return response()->json(array($user));

		}
		else
		{
			$myArray = ['status'=>'fail','reason'=>'New User'];
			return response()->json(array($myArray));	
		}
	}

	public function mobile_exist(Request $request)
	{
		
		if(check_mobile($request->role,$request->phone,$request->countrycode))
		{
			$users = User::where('role',$request->role)->where('phone',$request->phone)->where('countrycode',$request->countrycode);
			foreach ($users->get() as $user) 
			{}
			$user['status']='Success';
			return response()->json(array($user));
		}
		else
		{
			$myArray = ['status'=>'fail','reason'=>'New User'];
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

	public function getMap()
	{
		$final=array();
		$drivers=User::where("role",2)->where("lat",'<>',null)->where("long",'<>',null)->get();
		foreach ($drivers as $key => $value) {

			if($value->status=="1")
			{
				$fa_status_class="status success";
				$fa_status="Active";
			}
			else
			{
				$fa_status_class="status error";
				$fa_status="Pending";
			}
			if($value->online_status=="1")
			{
				$fa_ostatus_class="ostatus success";
				$fa_ostatus="Online";
			}
			else
			{
				$fa_ostatus_class="ostatus error";
				$fa_ostatus="Offline";
			}
			$data['firstname']=$value->firstname;
			$profile=$data['profile']=url("assets/images/avatar.png");
			$data['email']=$value->email;
			$data['countrycode']=$value->countrycode;
			$data['phone']=$value->phone;
			$data['category']=$value->category;
			$data['online_status']=$value->online_status;
			$data['status']=$value->status;
			$data['lat']=$value->lat;
			$data['long']=$value->long;
			$data['infowindow']='<div class="info_container">
			<img src="'.$profile.'">
			<p><i class="fa fa-user" aria-hidden="true"></i>'.$value->firstname.'</p>
			<p><i class="fa fa-heart '.$fa_status_class.'" aria-hidden="true"></i>'.$fa_status.'</p>
			<p><i class="fa fa-taxi '.$fa_ostatus_class.'" aria-hidden="true"></i>'.$fa_ostatus.'</p>
			</div>';
			$final[]=$data;
		}

		echo json_encode($final);
	}

	public function updatelocation(Request $request)
	{
		$data['lat']=$request->lat;
		$data['long']=$request->long;
		$ifuser=User::where('id',$request->user_id);
		if($ifuser->count()>0)
		{
			$update=User::where('id',$request->user_id)->update($data);
			$myArray = ['status'=>'Success'];
			return response()->json(array($myArray));
		}
		else
		{
			$myArray = ['status'=>'fail'];
			return response()->json(array($myArray));
		}	
	}

	public function updateOnlineStatus(Request $request)
	{
		$data['online_status']=$request->status;
		$ifuser=User::where('id',$request->user_id);
		if($ifuser->count()>0)
		{
			$update=User::where('id',$request->user_id)->update($data);
			$myArray = ['status'=>'Success'];
			return response()->json(array($myArray));
		}
		else
		{
			$myArray = ['status'=>'fail'];
			return response()->json(array($myArray));
		}
	}

	public function sendOTP(Request $request)
	{
		$twilio = new Twilio();
		$user=User::where('phone',$request->phone)->where('countrycode',$request->countrycode);
		if($user->count())
		{
			$verifycode=$user->first()->verifycode;
			$last_verified=$user->first()->last_verified;
			$current_time=time();
			if($verifycode=="")
			{
				$otp=generatePIN(4);
				$s=$twilio->sendSms("+".$request->countrycode.$request->phone,$otp.' is your trippy OTP to login');
				$data['verifycode']=$otp;
				$data['last_verified']=time();
				User::where('phone',$request->phone)->where('countrycode',$request->countrycode)->update($data);
			}
			else
			{
				$diff=round(abs($current_time - $last_verified) / 60,2);
				if($diff<=15)
				{
					$s=$twilio->sendSms("+".$request->countrycode.$request->phone,$verifycode.' is your trippy OTP to login');
				}
				else
				{
					$otp=generatePIN(4);
					$s=$twilio->sendSms("+".$request->countrycode.$request->phone,$otp.' is your trippy OTP to login');
					$data['verifycode']=$otp;
					$data['last_verified']=time();
					User::where('phone',$request->phone)->where('countrycode',$request->countrycode)->update($data);
				}
			}
			$myArray = ['status'=>'Success','message_status'=>$s->status];
			return response()->json(array($myArray));
		}
		else
		{
			$otp=generatePIN(4);
			$s=$twilio->sendSms("+".$request->countrycode.$request->phone,$otp.' is your trippy OTP to login');
			$data['verifycode']=$otp;
			$data['last_verified']=time();
			$data['phone']=$request->phone;
			$data['countrycode']=$request->countrycode;
			User::create($data);
			$myArray = ['status'=>'Success'];
			return response()->json(array($myArray));	
		}
	}

	public function updateOTP(Request $request)
	{
		$ifuser=User::where('phone',$request->phone)->where('countrycode',$request->countrycode)->where('verifycode',$request->verifycode);
		if($ifuser->count()>0)
		{
			$data['phone_verify']=1;
			$update=User::where('phone',$request->phone)->where('countrycode',$request->countrycode)->update($data);
		
			$users = User::where('phone',$request->phone)->where('countrycode',$request->countrycode)->where('role','<>',NULL);
			if($users->count()>0)
			{
				foreach ($users->get() as $user) 
				{}
		 	 	$user['status']='Success';				
				$user['userid'] = $user->id;
				return response()->json(array($user));
			}
			else
			{
				$myArray = ['status'=>'newUser'];
				return response()->json(array($myArray));
			}
		}
		else
		{
			$myArray = ['status'=>'fail'];
			return response()->json(array($myArray));
		}
	}
	public function sendEmailReminder(Request $request)
	{
	//dd(env('MAIL_HOST'));exit;
		$user['name'] ="Praveen";
		$user['email']="praveenak4286@gmail.com";
		Mail::send('emails.remainder', ['user' => $user], function ($m) use ($user) {
		    $m->from('praveenak.bsc@gmail.com', 'Your Application');
		
		    $m->to($user['email'], $user['name'])->subject('Your Reminder!');
		});
	}

}