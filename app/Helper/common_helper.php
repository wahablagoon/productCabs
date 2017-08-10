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


function api_settings($code)
{
	$settings = DB::table('api')->where("code",$code);
	if($settings->count()>0)
	{
		return $settings->first()->value;	
	}
	else
	{
		return false;	
	}
}


function site_name()
{
	$settings = DB::table('settings');
	if($settings->count()>0)
	{
		return $settings->first()->site_name;	
	}
	else
	{
		return false;	
	}
}

function site_settings()
{
	$settings = DB::table('settings');
	if($settings->count()>0)
	{
		return $settings->first();	
	}
	else
	{
		return false;	
	}
}

function check_id($role,$userid)
{
	$users = DB::table('users')->where('role',$role)->where('id',$userid);
	if($users->count()>0)
	{
		return true;	
	}
	else
	{
		return false;	
	}
}


function check_email($role,$email,$own="0")
{
	if($own!=0)
	{
		$users = DB::table('users')->where('role',$role)->where('email',$email)->where('id', '<>', $own);
	}
	else
	{
		$users = DB::table('users')->where('role',$role)->where('email',$email);
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

function check_mobile($role,$mobile,$countrycode,$own="0")
{
	if($own!=0)
	{
		$users = DB::table('users')->where('role',$role)->where('phone',$mobile)->where('countrycode',$countrycode)->where('id', '<>', $own);
	}
	else
	{
		$users = DB::table('users')->where('role',$role)->where('phone',$mobile)->where('countrycode',$countrycode);
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
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}