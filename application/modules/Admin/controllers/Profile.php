<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Admin_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model(array('group_model', 'user_model', 'users_groups_model'));
	}


	public function index()
	{

		$this->profile();

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

					redirect('admin/profile');

				}
			}

		}


		$this->mViewData['error'] = $error;
		$this->mViewData['error_msg'] = $error_msg;


		$this->mViewData['view_data'] = $user;

		// show group if user is webmaster or admin
		if ($this->ion_auth->in_group(array('webmaster', 'admin'))) {
			$groups = $this->group_model->get_all();
			foreach ($groups as $group) {
				$group->active = $this->ion_auth->in_group($group->id, $user_id);
			}

			if ($groups){
				$this->mViewData['groups'] = $groups;
			}
		}


		$this->render('user/view_profile_edit');

	}



	public function profile()
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
		$this->render('user/view_profile');
	}


	// Own Password change from profile page
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


	}

}
