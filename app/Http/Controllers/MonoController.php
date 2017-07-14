<?php

namespace App\Http\Controllers;

use App\Http\Requests ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
		$otp=generatePIN(4);
		$s=sendSms("+".$request->countrycode.$request->mobile,$otp.' is your trippy OTP to login');
		$data['verifycode']=$otp;
		DB::table('member')->where('id',$request->userid)->update($data);
		$myArray = ['status'=>'Success','message_status'=>$s->status];
		return response()->json(array($myArray));
	}

	public function updateOTP(Request $request)
	{
		$ifuser=DB::table('member')->where('id',$request->userid)->where('verifycode',$request->verifycode);
		if($ifuser->count()>0)
		{
			$data['phone_verify']=1;
			$update=DB::table('member')->where('id',$request->userid)->update($data);
			$myArray = ['status'=>'Success'];
			return response()->json(array($myArray));
		}
		else
		{
			$myArray = ['status'=>'fail'];
			return response()->json(array($myArray));
		}
	}

}
