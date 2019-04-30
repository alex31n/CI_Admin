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

$config['ax_config'] = array(

	// Raw PHP Headers
	'headers' => array(
		'Access-Control-Allow-Origin: *',
		'Access-Control-Allow-Methods: GET, POST, PUT, DELETE',
		//'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, X-API-KEY',
		'Content-Type: application/json;charset=utf-8',
	),



);
$config['enable_emulate_request'] = TRUE;
