<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->load->library(array('ax_form_builder' => 'form_builder'));
		//$this->load->library('message');
		$this->load->model(array('group_model', 'user_model', 'users_groups_model'));
	}


	public function index()
	{

		$this->all();

	}

	/*public function a()
	{

		print_r($this->mUser);
		exit();
	}*/


	public function all()
	{
		$this->set_page_title('Users');

		$this->add_stylesheet('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css');

		$this->add_script('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js');
		$this->add_script('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js');

		$users = $this->user_model
			->get_users_with_groups();

		$this->mViewData['users'] = $users;
		$this->render('user/view_user_all');

	}

	public function edit($user_id)
	{

		$this->set_page_title('Edit user');

		$error = false;
		$error_msg = array();

		$user = $this->user_model
			->get($user_id);

		if ($this->form_validation->run() === FALSE) {
			//$this->message->set_error(validation_errors());
			// $user = $this->input->post();
			if (validation_errors()) {
				$user = (object)$this->input->post();
				$error = true;
			}
		} else {

			$data = $this->input->post();

			// manual verification for username, email, phone
			if (!empty($data)) {
				$username_result = $this->user_model->where(array(
					'id !=' => $user_id,
					'username' => $data['username']
				))->count_rows();

				if ($username_result > 0) {
					$error = true;
					$error_msg['username'] = 'Username already exist!';
				}

				$email_count = $this->user_model->where(array('id !=' => $user_id, 'email' => $data['email']))->count_rows();
				if ($email_count > 0) {
					$error = true;
					$error_msg['email'] = 'Email already exist!';
				}

				$phone_count = $this->user_model->where(array('id !=' => $user_id, 'phone' => $data['phone']))->count_rows();
				if ($phone_count > 0) {
					$error = true;
					$error_msg['phone'] = 'Phone already exist!';
				}


			}

			// insert data if not get any error
			if (!$error) {
				$update_data = array(
					'username' => $data['username'],
					'email' => $data['email'],
					'first_name' => $data['first_name'],
					'last_name' => $data['last_name'],
					'phone' => $data['phone'],
					'active' => $data['active'],
				);

				//$result = $this->user_model->update($update_data, $user_id);
				$result = $this->ion_auth->update($user_id, $update_data);


				if (!$result) {
					$this->set_error_message('user information update failed');
				} else {
					$this->set_success_message('user information update successfully');
					//$this->message->set_success('user information update successfully');

					$groups = $data['groups'];

					// remove user from group
					$ac_groups = $this->ion_auth->get_users_groups($user_id)->result();

					$reGroups = array();
					foreach ($ac_groups as $g) {
						array_push($reGroups, $g->id);
					}

					$this->ion_auth->remove_from_group($reGroups, $user_id);

					// Add user to groups
					$this->ion_auth->add_to_group($groups, $user_id);

					redirect($this->mMenu['user']['url']);

				}
			}

		}


		$this->mViewData['error'] = $error;
		$this->mViewData['error_msg'] = $error_msg;


		$this->mViewData['view_data'] = $user;
		$groups = $this->group_model->get_all();
		foreach ($groups as $group) {
			$group->active = $this->ion_auth->in_group($group->id, $user_id);
		}


		$this->mViewData['groups'] = $groups;
		$this->render('user/view_user_edit');


	}


	public function new()
	{

		//$this->load->library('message');
		if ($this->form_validation->run() === FALSE) {
			//$this->message->set_error(validation_errors());
		} else {
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$identity = empty($username) ? $email : $username;
			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'phone' => $this->input->post('phone'),
			);
			$groups = $this->input->post('groups[]');

			// proceed to create user
			$user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $groups);
			if ($user_id) {
				// success
				$messages = $this->ion_auth->messages();
				$this->set_success_message($messages);

				// directly activate user
				$this->ion_auth->activate($user_id);
				redirect($this->mMenu['user']['url']);
			} else {
				// failed
				$errors = $this->ion_auth->errors();
				$this->set_error_message($errors);
				refresh();
			}


		}

		// get list of Frontend user groups
		$this->mViewData['groups'] = $this->group_model->get_all();
		$this->mPageTitle = 'Create User';
		$this->render('user/view_user_new');
	}

	public function reset_password($user_id)
	{

		// only top-level users can reset user passwords
		$this->verify_auth(array('webmaster', 'admin'));
		if ($this->form_validation->run() === FALSE) {
			//$this->message->set_error(validation_errors());
		} else {


			// pass validation
			$data = array('password' => $this->input->post('new_password'));

			// proceed to change user password
			if ($this->ion_auth->update($user_id, $data)) {
				//$messages = $this->ion_auth->messages();
				$this->set_success_message("Password reset Successfully!");
			} else {
				$errors = $this->ion_auth->errors();
				$this->set_error_message($errors);
			}

			redirect($this->mMenu['user']['url']);

		}

		$this->load->model('user_model');
		$userData = $this->user_model->get($user_id);
		$this->mViewData['user_data'] = $userData;
		$this->mPageTitle = 'Reset Password';
		$this->render('user/user_reset_password');
	}


	/*public function groups()
	{
		$this->mPageTitle = 'User Groups';
		$crud = $this->generate_crud('groups');
		$crud->required_fields('name');
		$crud->set_theme('axtablestrap');
		$this->render_crud();
	}*/


	public function groups()
	{
		$params = $this->uri->segment(4, 'all');
		$gId = $this->uri->segment(5, 0);

		if ($params == 'all') {
			$this->group_all();
		} elseif ($params == 'edit') {
			$this->group_edit();
		} elseif ($params == 'add') {
			$this->group_add();
		}
	}

	public function group_add()
	{
		$this->mPageTitle = 'Create Group';

		$this->form_validation->set_rules('name', 'Name', 'required|trim|is_unique[groups.name]',
			array(
				'is_unique' => 'Group already exist.'
			)
		);

		if ($this->form_validation->run() === FALSE) {
			//$this->message->set_error(validation_errors());
		} else {
			/*$name = $this->input->post('name');
			$description = $this->input->post('description');*/

			$data = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
			);

			$group_id = $this->group_model->insert($data);

			if ($group_id) {
				// success
				$this->set_success_message('Group create successfully');
				redirect($this->mMenu['user']['children']['Groups']);
			} else {
				// failed
				$this->set_error_message('Group create failed!');
			}


		}


		$this->render('groups/view_group_new');
	}

	public function group_all()
	{
		$this->set_page_title('User Groups');
		$this->add_stylesheet('https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css');

		$this->add_script('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js');
		$this->add_script('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js');

		$this->load->model('group_model');
		$this->mViewData['groups'] = $this->group_model
			->order_by(array('id' => 'ASC'))
			->get_all();
		$this->render('groups/view_group_all');
	}


	public function group_edit()
	{
		$this->set_page_title('Edit User Groups');

		$gId = $this->uri->segment(5, 0);

		$this->form_validation->set_rules('name', 'Name', 'required');

		if ($this->form_validation->run() == FALSE) {
			// $this->message->set_error(validation_errors());

		} else {
			$data = array(
				//'id'			=>	$gId,
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
			);

			$result = $this->group_model->update($data, $gId);
			if ($result) {
				$this->set_success_message('Group update successfully!');
				redirect($this->mMenu['user']['children']['Groups']);
			}
		}


		$this->mViewData['group'] = $this->group_model
			->get($gId);

		$this->render('groups/view_group_edit');

	}

	public function group_delete()
	{

		if (!$this->input->is_ajax_request()) {
			exit('no valid request...');
		}


		$id = $this->input->post('id');

		$result = $this->group_model->force_delete($id);

		$status = "";
		if ($result) {
			$this->set_success_message('Delete successfully!');
			$status = 'true';
		} else {
			$this->set_error_message('Error while data deleting');
			$status = 'false';
		}

		echo $status;

	}

	public function user_delete()
	{
		if (!$this->input->is_ajax_request()) {
			exit('no valid request...');
		}

		$id = $this->input->post('id');

		$result = $this->ion_auth->delete_user($id);

		$status = "";
		if ($result) {
			$this->set_success_message('User delete successfully!');
			$status = 'true';
		} else {
			$this->set_error_message('Error while user deleting');
			$status = 'false';
		}

		echo $status;
	}


	/*public function profile()
	{
		$user = $this->mUser;
		if ($user) {
			$group = $this->users_groups_model->get_user_groups($user->id);

			if ($group) {
				$user->groups = $group;
			}
		}

		$this->set_page_title($user->first_name . ' ' . $user->last_name);

		$this->mViewData['user'] = $user;
		$this->render('user/view_user_profile');
	}*/


	/*// Own Password change from profile page
	public function change_password($user_id)
	{
		$this->set_page_title("Change Password");
		$this->load->model('ion_auth_model');

		if ($this->form_validation->run() === FALSE) {
			//$this->message->set_error(validation_errors());

		}else{

			$oldPassword = $this->input->post('old_password');
			$password = $this->input->post('new_password');

			$user = $this->user_model->where('id',$user_id)->get();

			$result = $this->ion_auth_model->change_password($user->username, $oldPassword, $password);

			if ($result) {
				$this->set_success_message("Password change Successfully!");
				redirect('admin/profile');
			} else {
				$errors = $this->ion_auth->errors();
				$this->set_error_message($errors);
				refresh();
			}

		}


		$this->mViewData['user'] = $this->mUser;
		$this->render('user/view_profile_password');

	}*/

}
