<?php

class Api_Controller extends REST_Controller {


	// API Key object to represent identity consuming the API endpoint
	protected $mApiKey = NULL;

	public function __construct()
	{
		parent::__construct();

		//$this->load->library('Authorization_token');

		$config = $this->config->item('ax_config');
		$headers = empty($config['headers']) ? array() : $config['headers'];
		foreach ($headers as $header) {
			header($header);
		}

		$this->verify_token();

	}


	// Verify access token (e.g. API Key, JSON Web Token)
	public function verify_token()
	{
		$key = $this->input->get_request_header('X-API-KEY');
		$this->mApiKey = $this->api_model->where('key', $key)->get();

		if (!empty($this->mApiKey)) {
			$this->load->model('admin/user_model');

			$this->mUser = $this->user_model->db->select('id, first_name, last_name, username, email, phone, active')
				->where('id', $this->mApiKey->user_id)
				->from($this->user_model->table)
				->get()
				->row(0);

			// only when the API Key represents a user
			if ( !empty($this->mUser) )
			{
				$this->mUserGroups = $this->ion_auth->get_users_groups($this->mUser->id)->result();

				// TODO: get group with most permissions (instead of getting first group)
				$this->mUserMainGroup = $this->mUserGroups[0]->name;
			}
			else
			{
				// anonymous access via API Key
				$this->mUserMainGroup = 'anonymous';
			}

		}

	}

	/**
	 * get access token from header
	 * */
	/*protected function getBearerToken()
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
	}*/

	/**
	 * Get header Authorization
	 * */
	/*protected function getAuthorizationHeader()
	{
		$headers = null;
		if (isset($_SERVER['Authorization'])) {
			$headers = trim($_SERVER["Authorization"]);
		} else if (isset($_SERVER['x-access-token'])) {
			$headers = trim($_SERVER["x-access-token"]);
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
	}*/

}
