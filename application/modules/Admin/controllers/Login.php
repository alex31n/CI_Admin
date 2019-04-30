<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->ion_auth->logged_in())
		{
			redirect('admin');
		}
	}

	/**
	 * Login page and submission
	 */
	public function index()
	{
		$this->load->library('form_builder');
		$form = $this->form_builder->create_form();
		//$form->set_rule_group('login');
		if ($form->validate())
		{
			// passed validation
			$identity = $this->input->post('username');
			$password = $this->input->post('password');
			$remember = ($this->input->post('remember')=='on');

			if ($this->ion_auth->login($identity, $password, $remember))
			{
				// login succeed
				// $messages = $this->ion_auth->messages();
				// $this->system_message->set_success($messages);
				redirect($this->mModule);
			}
			else
			{
				// login failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
				refresh();
			}
		}

		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->mBodyClass = 'login-page';
		$this->render('view_login', 'empty');
	}



}
