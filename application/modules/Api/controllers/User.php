<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends Api_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('token');
	}

	public function index(){
		//echo 'api user index';

		print_r($this->mAction);
	}

	public function test_get(){
		//print_r("test get method");

		$user = array(
			'id'=>1,
			'name'=>'alex'
		);

		$this->response();

	}


	public function login()
	{
		$identity = $this->input->post('username');
		$password = $this->input->post('password');

		if ($this->ion_auth->login($identity, $password))
		{
			$id = $this->ion_auth->get_user_id();
			print_r('User id '.$id);
		}else{
			print_r('fasle');
		}

	}



}
