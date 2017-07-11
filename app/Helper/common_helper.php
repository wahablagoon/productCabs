<?php

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