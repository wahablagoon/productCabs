<?php

function check_rider_email($email)
{
	$users = DB::table('member')->where('role',1)->where('email',$email);
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}

function check_rider_mobile($mobile,$countrycode)
{
	$users = DB::table('member')->where('role',1)->where('phone',$mobile)->where('countrycode',$countrycode);
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

function check_driver_email($email)
{
	$users = DB::table('member')->where('role',2)->where('email',$email);
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}

function check_driver_mobile($mobile,$countrycode)
{
	$users = DB::table('member')->where('role',2)->where('phone',$mobile)->where('countrycode',$countrycode);
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

