<?php

namespace App\Http\Controllers;

use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use View;
use Illuminate\Support\Facades\DB;

class MonoController extends Controller
{

	public function index()
	{
	    $myArray = ['id'=>1, 'name'=>'HD'];

	    return response()->json($myArray);
	}

	public function getCategory(Request $request)
	{
		$cat=DB::table('car_category')->get();
		foreach ($cat as $key => $value) {
			$array['category_name']=$value->category_name;
			$array['price_km']=$value->price_km;
			$array['price_minute']=$value->price_minute;
			$array['max_size']=$value->max_size;
			$array['price_fare']=$value->price_fare;
			$array['logo']=$value->logo;
			$array['marker']=$value->marker;
			$myArray[]=$array;
		}
	    return response()->json($myArray);

	}
	public function updateLocation(Request $request)
	{
		$userid=$request->userid;
		$data['lat']=$request->lat;
		$data['long']=$request->long;
		$ifuser=DB::table('member')->where('id',$userid);
		if($ifuser->count()>0)
		{
			$update=DB::table('member')->where('id',$userid)->update($data);
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
		$user=DB::table('member')->where('phone',$request->mobile)->where('countrycode',$request->countrycode);
		if($user->count())
		{
			$verifycode=$user->first()->verifycode;
			$last_verified=$user->first()->last_verified;
			$current_time=time();
			if($verifycode=="")
			{
				$otp=generatePIN(4);
				$s=sendSms("+".$request->countrycode.$request->mobile,$otp.' is your trippy OTP to login');
				$data['verifycode']=$otp;
				$data['last_verified']=time();
				DB::table('member')->where('phone',$request->mobile)->where('countrycode',$request->countrycode)->update($data);
			}
			else
			{
				$diff=round(abs($current_time - $last_verified) / 60,2);
				if($diff<=15)
				{
					$s=sendSms("+".$request->countrycode.$request->mobile,$verifycode.' is your trippy OTP to login');
				}
				else
				{
					$otp=generatePIN(4);
					$s=sendSms("+".$request->countrycode.$request->mobile,$otp.' is your trippy OTP to login');
					$data['verifycode']=$otp;
					$data['last_verified']=time();
					DB::table('member')->where('phone',$request->mobile)->where('countrycode',$request->countrycode)->update($data);
				}
			}
			$myArray = ['status'=>'Success','message_status'=>$s->status];
			return response()->json(array($myArray));
		}
		else
		{
			$myArray = ['status'=>'fail'];
			return response()->json(array($myArray));	
		}
	}

	public function updateOTP(Request $request)
	{
		$ifuser=DB::table('member')->where('phone',$request->mobile)->where('countrycode',$request->countrycode)->where('verifycode',$request->verifycode);
		if($ifuser->count()>0)
		{
			$data['phone_verify']=1;
			$update=DB::table('member')->where('phone',$request->mobile)->where('countrycode',$request->countrycode)->update($data);
			$myArray = ['status'=>'Success'];
			return response()->json(array($myArray));
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
