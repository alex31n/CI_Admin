<?php

/**
 * Config file for form validation
 * Reference: http://www.codeigniter.com/user_guide/libraries/form_validation.html
 * (Under section "Creating Sets of Rules")
 */

$config = array(

	// Admin User Login
	'login/index' => array(
		array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'required',
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required',
		),
	),


	// Create User
	'user/new' => array(
		array(
			'field' => 'first_name',
			'label' => 'First Name',
			'rules' => 'required',
		),
		array(
			'field' => 'last_name',
			'label' => 'Last Name',
			'rules' => 'required',
		),
		array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'required|min_length[3]|is_unique[users.username]',
			'errors' => array(
				'is_unique' => '%s already exist.'
			),
		),
		array(
			'field' => 'phone',
			'label' => 'Phone',
			'rules' => 'required|is_unique[users.phone]',
			'errors' => array(
				'is_unique' => '%s number already exist.'
			),
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'is_unique[users.email]',
			'errors' => array(
				'is_unique' => '%s already exist.'
			),
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|min_length[6]',
		),
		array(
			'field' => 'confirm_password',
			'label' => 'Confirm Password',
			'rules' => 'required|matches[password]',
		),
	),

	// Edit User
	'user/edit' => array(
		array(
			'field' => 'first_name',
			'label' => 'First Name',
			'rules' => 'required',
		),
		array(
			'field' => 'last_name',
			'label' => 'Last Name',
			'rules' => 'required',
		),
		array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'required|min_length[3]',
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'valid_email',
			'errors' => array(
				'valid_email' => 'Enter valid email'
			),
		),
		array(
			'field' => 'phone',
			'label' => 'Phone',
			'rules' => 'required',
		)
	),

	// Reset User Password
	'user/reset_password' => array(
		array(
			'field'		=> 'new_password',
			'label'		=> 'New Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'confirm_password',
			'label'		=> 'Confirm Password',
			'rules'		=> 'required|matches[new_password]',
		),
	),


	// won User edit profile
	'profile/edit' => array(
		array(
			'field' => 'first_name',
			'label' => 'First Name',
			'rules' => 'required',
		),
		array(
			'field' => 'last_name',
			'label' => 'Last Name',
			'rules' => 'required',
		),
		array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'required|min_length[3]',
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'valid_email',
			'errors' => array(
				'valid_email' => 'Enter valid email'
			),
		),
		array(
			'field' => 'phone',
			'label' => 'Phone',
			'rules' => 'required',
		)
	),

	// Own user Password change from profile page
	'profile/change_password' => array(
		array(
			'field'		=> 'old_password',
			'label'		=> 'Old Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'new_password',
			'label'		=> 'New Password',
			'rules'		=> 'required',
		),
		array(
			'field'		=> 'confirm_password',
			'label'		=> 'Confirm Password',
			'rules'		=> 'required|matches[new_password]',
		),
	),

	// user groups
	/*'user/groups/add' => array(
		array(
			'field'		=> 'name',
			'label'		=> 'Name',
			'rules'		=> 'required',
			'errors' => array(
				'is_unique' => '%s already exist.'
			),
		),
	),*/

	'user/groups/edit/(:any)' => array(
		array(
			'field'		=> 'name',
			'label'		=> 'name',
			'rules'		=> 'required',
			'errors' => array(
				'is_unique' => '%s already exist.'
			),
		),
	),






);
