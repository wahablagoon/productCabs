<?php

function is_loggedin()
{
	if(session('trippy_loggedin'))
	{
		return true;
	}
	else
	{
		return false;
	}
}



function check_rider_id($userid)
{
	$users = DB::table('member')->where('role',1)->where('id',$userid);
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}


function check_rider_email($email,$own="0")
{
	if($own!=0)
	{
		$users = DB::table('member')->where('role',1)->where('email',$email)->where('id', '<>', $own);
	}
	else
	{
		$users = DB::table('member')->where('role',1)->where('email',$email);
	}
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}

function check_rider_mobile($mobile,$countrycode,$own="0")
{
	if($own!=0)
	{
		$users = DB::table('member')->where('role',1)->where('phone',$mobile)->where('id', '<>', $own);
	}
	else
	{
		$users = DB::table('member')->where('role',1)->where('phone',$mobile)->where('countrycode',$countrycode);
	}
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}

function check_rider_facebook($fb_id)
{
	$users = DB::table('member')->where('role',1)->where('facebook_id',$fb_id);
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}

function check_rider_google($google_id)
{
	$users = DB::table('member')->where('role',1)->where('google_id',$google_id);
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}

function check_driver_id($userid)
{
	$users = DB::table('member')->where('role',2)->where('id',$userid);
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}


function check_driver_email($email,$own=0)
{
	if($own!=0)
	{
		$users = DB::table('member')->where('role',2)->where('email',$email)->where('id', '<>', $own);
	}
	else
	{
		$users = DB::table('member')->where('role',2)->where('email',$email);
	}
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}

function check_driver_mobile($mobile,$countrycode,$own="0")
{
	if($own!=0)
	{
		$users = DB::table('member')->where('role',2)->where('phone',$mobile)->where('countrycode',$countrycode)->where('id', '<>', $own);
	}
	else
	{	
		$users = DB::table('member')->where('role',2)->where('phone',$mobile)->where('countrycode',$countrycode);
	}
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}

function check_driver_facebook($fb_id)
{
	$users = DB::table('member')->where('role',2)->where('facebook_id',$fb_id);
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}

function check_driver_google($google_id)
{
	$users = DB::table('member')->where('role',2)->where('google_id',$google_id);
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}

function updatelocation($request)
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

function sendSms($to, $body)
{
	$id = "ACcbe5062f48b4b80892f2660ea73cf0b5";
	$token = "ac08f91a02769ace9798b89ad3762ca0";
	$url = "https://api.twilio.com/2010-04-01/Accounts/$id/SMS/Messages.json";
	$from = "+12679301259";
	$data = array (
	    'From' => $from,
	    'To' => $to,
	    'Body' => $body,
	);
	$post = http_build_query($data);
	$x = curl_init($url );
	curl_setopt($x, CURLOPT_POST, true);
	curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
	curl_setopt($x, CURLOPT_POSTFIELDS, $post);
	$y = curl_exec($x);
	curl_close($x);
	$res=json_decode($y);
	return $res;
}

function generatePIN($digits = 4){
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while($i < $digits){
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}