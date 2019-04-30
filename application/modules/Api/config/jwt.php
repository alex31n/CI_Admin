<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| JWT Config
| -------------------------------------------------------------------------
| Values to be used in Jwt Client library
|
*/

$config['jwt_issuer'] = 'CI Bootstrap 3';

// must be non-empty
$config['jwt_key'] = 'eyJ0eXAiOiJKV1QiLCJhbGciTWvLUzI1NiJ9IiRkYXRhIg';

// expiry time since a JWT is issued (in seconds); set NULL to never expired
$config['jwt_expiry'] = NULL;

/*
|--------------------------------------------------------------------------
| JWT Algorithm Type
|--------------------------------------------------------------------------
*/
$config['jwt_algorithm'] = 'HS256';
