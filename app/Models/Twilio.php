<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Twilio extends Model
{
	public $TWILIO_URL;
    public $TWILIO_ID;
    public $TWILIO_TOKEN;
    public $TWILIO_FROM;
	
	public function __construct(array $attributes = array())
	{
	    parent::__construct($attributes);	    
		$this->TWILIO_ID = api_settings("TWILIO_SID");
		$this->TWILIO_URL = "https://api.twilio.com/2010-04-01/Accounts/$this->TWILIO_ID/SMS/Messages.json";
		$this->TWILIO_TOKEN =api_settings("TWILIO_TOKEN");
		$this->TWILIO_FROM =api_settings("TWILIO_FROM");
	}

	public function sendSms($to, $body)
	{
		$data = array (
		    'From' => $this->TWILIO_FROM,
		    'To' => $to,
		    'Body' => $body,
		);
		$post = http_build_query($data);
		$x = curl_init($this->TWILIO_URL);
		curl_setopt($x, CURLOPT_POST, true);
		curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($x, CURLOPT_USERPWD, "$this->TWILIO_ID:$this->TWILIO_TOKEN");
		curl_setopt($x, CURLOPT_POSTFIELDS, $post);
		$y = curl_exec($x);
		curl_close($x);
		$res=json_decode($y);
		return $res;
	}
}
