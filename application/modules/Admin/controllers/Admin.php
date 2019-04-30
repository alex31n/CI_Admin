<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_controller {

	public function index()
	{
		$this->set_page_title('Admin');
		$this->render("_content");
		//$this->load->view('welcome_message');
	}
	public function alex()
	{
		$this->mPageTitle = 'Alex';
		$this->session->set_flashdata('success', 'Something is wrong.');

		$this->render("alex");
		//$this->load->view('welcome_message');
	}




	/*public function login()
	{
		$identity="admin@admin.com";
		$password ="password";
		$remember=true;
		$user = $this->ion_auth->login($identity, $password, $remember);
		var_dump($user);
	}*/


}
