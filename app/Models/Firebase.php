<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Firebase\Token\TokenException;
use Firebase\Token\TokenGenerator;

class Firebase extends Model
{
	public $FIREBASE_URL;
    public $FIREBASE_SECRET;
    public $FIREBASE_UID;
	
	public function __construct(array $attributes = array())
	{
	    parent::__construct($attributes);
	    $this->FIREBASE_URL = api_settings("f_URL");
		$this->FIREBASE_SECRET = api_settings("f_SECRET");
		$this->FIREBASE_UID =api_settings("f_UID");
	}

	public function generate_token()
	{
		try {
		    $generator = new TokenGenerator($this->FIREBASE_SECRET);
		    $token = $generator
		        ->setData(array('uid' => $this->FIREBASE_UID))
		        ->create();
		    return $token;
		} catch (TokenException $e) {
		    echo "Error: ".$e->getMessage();
		}
	}

	public function getdata($path)
	{
		$token=$this->generate_token();
		$firebase = new \Firebase\FirebaseLib($this->FIREBASE_URL, $token);
		return $firebase->get($path);
		// --- reading the stored string ---
		//$name = $firebase->get($DEFAULT_PATH . '/58dfb254192d2e5256234fde');
		//return $name;
	}

	public function setdata($path,$data)
	{
		//echo $this->FIREBASE_URL;
		$token=$this->generate_token();
		$firebase = new \Firebase\FirebaseLib($this->FIREBASE_URL, $token);

		$firebase->set($path,$data);
	}
    public function updatedata($path,$data)
    {
            //echo $this->FIREBASE_URL;
            $token=$this->generate_token();
            $firebase = new \Firebase\FirebaseLib($this->FIREBASE_URL, $token);

            $firebase->update($path,$data);
    }
}
