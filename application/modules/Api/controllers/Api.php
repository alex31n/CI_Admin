<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Api extends Api_Controller
{

	public function __construct()
	{
		$this->load->library('token');
	}

	public function index(){
		print_r('index api');
	}


	public function generate_token()
	{

		$data = array(
			'key'=>random_string('unique'),
			'time'=>time(),
		);

		if (!empty($id)){
			$data['id']= 1;
		}

		$token = $this->token->encode($data);
		print_r($token);

	}

	// Verify access token (e.g. API Key, JSON Web Token)
	public function token()
	{

		$token = $this->getBearerToken();

		$tokenData = $this->authorization_token->decode($token);

		if ($tokenData){
			$key = $tokenData['jti'];
			$id = $tokenData['id'];

			$apikeys = $this->is_api_key_exist($key);
			print_r($apikeys);

		}


	}

	private function is_api_key_exist($key){

		$this->load->model('api_model');

		$apiKeys = $this->api_model->where('token', $key)->get();

		return $apiKeys;

	}


	/**
	 * get access token from header
	 * */
	protected function getBearerToken()
	{
		//$headers = $this->getAuthorizationHeader();

		$authHeader = $this->input->get_request_header('Authorization');

		// HEADER: Get the access token from the header
		if (!empty($authHeader)) {
			if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
				return $matches[1];
			}
		}
		return null;
	}

	/**
	 * Get header Authorization
	 * */
	protected function getAuthorizationHeader()
	{
		$headers = null;
		if (isset($_SERVER['Authorization'])) {
			$headers = trim($_SERVER["Authorization"]);
		} else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
			$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
		} elseif (function_exists('apache_request_headers')) {
			$requestHeaders = apache_request_headers();
			// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
			$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
			//print_r($requestHeaders);
			if (isset($requestHeaders['Authorization'])) {
				$headers = trim($requestHeaders['Authorization']);
			}
		}
		return $headers;
	}

}
