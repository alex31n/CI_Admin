<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * @property  mApiKey
 */
class Rest extends MX_Controller
{

	// API Key object to represent identity consuming the API endpoint
	protected $mApiKey = NULL;

	public function __construct()
	{
		parent::__construct();

		$config = $this->config->item('ax_config');
		$headers = empty($config['headers']) ? array() : $config['headers'];
		foreach ($headers as $header) {
			header($header);
		}

		$this->verify_token();

	}

	function index()
	{


	}


	protected function verify_token()
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

}
