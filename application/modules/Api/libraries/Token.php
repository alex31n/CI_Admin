<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Token
{


	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
	}


	// Encode to token
	public function encode($data = array())
	{
		$json = json_encode($data);
		$string = base64_encode($json);
		return rtrim($string,"=");
	}



	// Decode token
	// Return NULL when exception is caught
	public function decode($token)
	{


	}

}
