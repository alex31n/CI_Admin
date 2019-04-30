<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('api_keys_model');
	}

	/**
	 * Settings page and submission
	 */
	public function index()
	{
		echo time();
	}

	public function api()
	{
		$this->set_page_title('API Management');

		$this->add_stylesheet('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css');

		$this->add_script('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js');
		$this->add_script('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js');

		$api_keys = $this->api_keys_model->get_all();

		$this->mViewData['apis'] = $api_keys;
		$this->render('api/view_api_all');
	}


	public function apichstatus()
	{
		if (!$this->input->is_ajax_request()) {
			exit('no valid request...');
		}

		$id = $this->input->post('id');

		$update_data = array(
			'status' => $this->input->post('status'),
		);

		$result = $this->api_keys_model->update($update_data, $id);

		$status = "";
		if ($result) {
			$this->set_success_message('Update successfully!');
			$status = 'true';
		} else {
			$this->set_error_message('Error occur while update');
			$status = 'false';
		}

		echo $status;

	}


}
