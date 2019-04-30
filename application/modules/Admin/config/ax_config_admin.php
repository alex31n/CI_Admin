<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views
| when calling MY_Controller's render() function.
|
| See example and detailed explanation from:
| 	/application/config/ci_bootstrap_example.php
*/

$config['ax_config_admin'] = array(

	/*// Site name
	'site_name' => SITE_NAME,

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => '',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> '',
		'description'	=> '',
		'keywords'		=> ''
	),

	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
			'assets/jquery/3.3.1/jquery.min.js',
			'assets/popper.js/1.14.7/popper.min.js',
			'assets/bootstrap/4.1.3/js/bootstrap.min.js',
		),
		'foot'	=> array(
			'assets/extra/js/fastclick.js',
			'assets/extra/js/jquery.nicescroll.js',
			'assets/extra/js/detect.js',
			'assets/pikeadmin/2.3/js/pikeadmin.js',
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/bootstrap/4.1.3/css/bootstrap.min.css',
			'assets/font-awesome/css/font-awesome.min.css',
			// 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
			'assets/pikeadmin/2.3/css/style.css',
			'assets/alx/css/style.css',
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',

	// Multilingual settings
	'languages' => array(
		'default'		=> 'en',
		'autoload'		=> array('general'),
		'available'		=> array(
			'en' => array(
				'label'	=> 'English',
				'value'	=> 'english'
			),
			'zh' => array(
				'label'	=> '繁體中文',
				'value'	=> 'traditional-chinese'
			),
			'cn' => array(
				'label'	=> '简体中文',
				'value'	=> 'simplified-chinese'
			),
			'es' => array(
				'label'	=> 'Español',
				'value' => 'spanish'
			)
		)
	),

	// Google Analytics User ID
	'ga_id' => '',*/

	// Menu items
	'menu' => array(

		'home' => array(
			'name'		=> 'Dashboard',
			'url'		=> 'admin',
			'icon'		=> 'fa fa-fw fa-bars',
		),
		'user' => array(
			'name'		=> 'Users',
			'url'		=> 'admin/user',
			'icon'		=> 'fa fa-fw fa-users',
			'children'  => array(
				'New'			=> 'admin/user/new',
				'All Users'		=> 'admin/user/all',
				'Groups'		=> 'admin/user/groups',
			)
		),
		'settings' => array(
			'name'		=> 'Settings',
			'url'		=> 'admin/settings',
			'icon'		=> 'fa fa-fw fa-cog',
			'children'  => array(
				'API Keys'			=> 'admin/settings/api',

			)
		),


	),

	/*// Login page
	'login_url' => 'admin/login',
	'logout_url' => 'admin/logout',

	// Restricted pages
	'page_auth' => array(
	),

	// AdminLTE settings
	'adminlte' => array(
		'body_class' => array(
			'webmaster'	=> 'skin-red',
			'admin'		=> 'skin-purple',
			'manager'	=> 'skin-black',
			'staff'		=> 'skin-blue',
		)
	),

	// Email config
	'email' => array(
		'from_email'		=> '',
		'from_name'			=> '',
		'subject_prefix'	=> '',

		// Mailgun HTTP API
		'mailgun_api'		=> array(
			'domain'			=> '',
			'private_api_key'	=> ''
		),
	),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
	),*/
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
$config['sess_cookie_name'] = 'ci_session_frontend';
