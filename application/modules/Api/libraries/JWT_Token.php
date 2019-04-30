<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *   Authorization_Token
 * -------------------------------------------------------------------
 * API Token Check and Generate
 *
 * @author: Jeevan Lal
 * @version: 0.0.5
 */
require_once APPPATH . 'third_party/php-jwt/JWT.php';
require_once APPPATH . 'third_party/php-jwt/BeforeValidException.php';
require_once APPPATH . 'third_party/php-jwt/ExpiredException.php';
require_once APPPATH . 'third_party/php-jwt/SignatureInvalidException.php';

use \Firebase\JWT\JWT;

class JWT_Token
{

	/**
	 * Token Key
	 */
	protected $jwt_key;
	/**
	 * Token algorithm
	 */
	protected $jwt_algorithm;

	// Claim info
	private $jwt_issuer;
	private $mExpiry;


	private $CI;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('acrypt');
		/**
		 * jwt config file load
		 */
		$this->CI->load->config('jwt');
		/**
		 * Load Config Items Values
		 */
		$this->jwt_issuer = $this->CI->config->item('jwt_issuer');
		$this->jwt_key = $this->CI->config->item('jwt_key');
		$this->jwt_algorithm = $this->CI->config->item('jwt_algorithm');
	}


	// Encode to JWT
	// Append custom data via $data array, e.g. array('user_id' => 1)
	public function encode($data = array())
	{
		// References:
		// 	- http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html
		// 	- http://websec.io/2014/08/04/Securing-Requests-with-JWT.html
		//
		// Registered Claim Names (all optional):
		// 	- iss = Issuer
		// 	- sub = Subject
		// 	- aud = Audience
		// 	- exp = Expiration Time
		// 	- nbf = Not Before
		// 	- iat = Issued At
		// 	- jti = JWT ID
		$curr_time = time();
		$token = array(
			"iss" => $this->jwt_issuer,
			"iat" => $curr_time,
			"jti" => random_string('unique')
		);

		// add expiry when necessary
		if (!empty($this->mExpiry))
			$token['exp'] = $curr_time + $this->mExpiry;

		// append data to store with token
		if (!empty($data))
			$token = array_merge($token, $data);

		// encode and return string
		return JWT::encode($token, $this->jwt_key, $this->jwt_algorithm);
	}

	public function get_token($data)
	{
		return JWT::encode($data, $this->jwt_key, $this->jwt_algorithm);
	}

	// Decode token
	// Return NULL when exception is caught
	public function decode($jwt)
	{

		try {
			$decoded = JWT::decode($jwt, $this->jwt_key, array($this->jwt_algorithm));
			return (array)$decoded;
		} catch (\Firebase\JWT\SignatureInvalidException $e) {
			// invalid JWT
			print_r($e);
			return NULL;
		} catch (\Firebase\JWT\ExpiredException $e) {
			// JWT is expired
			return NULL;
		} catch (\Firebase\JWT\BeforeValidException $e) {
			// JWT is not valid yet
			return NULL;
		} catch (Exception $e) {
			// other exceptions
			return NULL;
		}
	}

}
