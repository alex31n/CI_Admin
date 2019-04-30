<?php

/**
 * Base controllers for different purposes
 *    - MY_Controller: for Frontend Website
 *    - Admin_Controller: for Admin Panel (require login), extends from MY_Controller
 *    - API_Controller: for API Site, extends from REST_Controller
 */
class REST_Controller extends MX_Controller
{


	// Note: Only the widely used HTTP status codes are documented

	// Informational

	const HTTP_CONTINUE = 100;
	const HTTP_SWITCHING_PROTOCOLS = 101;
	const HTTP_PROCESSING = 102;            // RFC2518

	// Success

	/**
	 * The request has succeeded
	 */
	const HTTP_OK = 200;

	/**
	 * The server successfully created a new resource
	 */
	const HTTP_CREATED = 201;
	const HTTP_ACCEPTED = 202;
	const HTTP_NON_AUTHORITATIVE_INFORMATION = 203;

	/**
	 * The server successfully processed the request, though no content is returned
	 */
	const HTTP_NO_CONTENT = 204;
	const HTTP_RESET_CONTENT = 205;
	const HTTP_PARTIAL_CONTENT = 206;
	const HTTP_MULTI_STATUS = 207;          // RFC4918
	const HTTP_ALREADY_REPORTED = 208;      // RFC5842
	const HTTP_IM_USED = 226;               // RFC3229

	// Redirection

	const HTTP_MULTIPLE_CHOICES = 300;
	const HTTP_MOVED_PERMANENTLY = 301;
	const HTTP_FOUND = 302;
	const HTTP_SEE_OTHER = 303;

	/**
	 * The resource has not been modified since the last request
	 */
	const HTTP_NOT_MODIFIED = 304;
	const HTTP_USE_PROXY = 305;
	const HTTP_RESERVED = 306;
	const HTTP_TEMPORARY_REDIRECT = 307;
	const HTTP_PERMANENTLY_REDIRECT = 308;  // RFC7238

	// Client Error

	/**
	 * The request cannot be fulfilled due to multiple errors
	 */
	const HTTP_BAD_REQUEST = 400;

	/**
	 * The user is unauthorized to access the requested resource
	 */
	const HTTP_UNAUTHORIZED = 401;
	const HTTP_PAYMENT_REQUIRED = 402;

	/**
	 * The requested resource is unavailable at this present time
	 */
	const HTTP_FORBIDDEN = 403;

	/**
	 * The requested resource could not be found
	 *
	 * Note: This is sometimes used to mask if there was an UNAUTHORIZED (401) or
	 * FORBIDDEN (403) error, for security reasons
	 */
	const HTTP_NOT_FOUND = 404;

	/**
	 * The request method is not supported by the following resource
	 */
	const HTTP_METHOD_NOT_ALLOWED = 405;

	/**
	 * The request was not acceptable
	 */
	const HTTP_NOT_ACCEPTABLE = 406;
	const HTTP_PROXY_AUTHENTICATION_REQUIRED = 407;
	const HTTP_REQUEST_TIMEOUT = 408;

	/**
	 * The request could not be completed due to a conflict with the current state
	 * of the resource
	 */
	const HTTP_CONFLICT = 409;
	const HTTP_GONE = 410;
	const HTTP_LENGTH_REQUIRED = 411;
	const HTTP_PRECONDITION_FAILED = 412;
	const HTTP_REQUEST_ENTITY_TOO_LARGE = 413;
	const HTTP_REQUEST_URI_TOO_LONG = 414;
	const HTTP_UNSUPPORTED_MEDIA_TYPE = 415;
	const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
	const HTTP_EXPECTATION_FAILED = 417;
	const HTTP_I_AM_A_TEAPOT = 418;                                               // RFC2324
	const HTTP_UNPROCESSABLE_ENTITY = 422;                                        // RFC4918
	const HTTP_LOCKED = 423;                                                      // RFC4918
	const HTTP_FAILED_DEPENDENCY = 424;                                           // RFC4918
	const HTTP_RESERVED_FOR_WEBDAV_ADVANCED_COLLECTIONS_EXPIRED_PROPOSAL = 425;   // RFC2817
	const HTTP_UPGRADE_REQUIRED = 426;                                            // RFC2817
	const HTTP_PRECONDITION_REQUIRED = 428;                                       // RFC6585
	const HTTP_TOO_MANY_REQUESTS = 429;                                           // RFC6585
	const HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;                             // RFC6585

	// Server Error

	/**
	 * The server encountered an unexpected error
	 *
	 * Note: This is a generic error message when no specific message
	 * is suitable
	 */
	const HTTP_INTERNAL_SERVER_ERROR = 500;

	/**
	 * The server does not recognise the request method
	 */
	const HTTP_NOT_IMPLEMENTED = 501;
	const HTTP_BAD_GATEWAY = 502;
	const HTTP_SERVICE_UNAVAILABLE = 503;
	const HTTP_GATEWAY_TIMEOUT = 504;
	const HTTP_VERSION_NOT_SUPPORTED = 505;
	const HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL = 506;                        // RFC2295
	const HTTP_INSUFFICIENT_STORAGE = 507;                                        // RFC4918
	const HTTP_LOOP_DETECTED = 508;                                               // RFC5842
	const HTTP_NOT_EXTENDED = 510;                                                // RFC2774
	const HTTP_NETWORK_AUTHENTICATION_REQUIRED = 511;



	/**
	 * Contains details about the request
	 * Fields: class, module, body, format, method,
	 * Note: This is a dynamic object (stdClass)
	 *
	 * @var object
	 */
	protected $request = NULL;

	protected $mModule;
	protected $mClass;
	protected $mMethod;


	/**
	 * Contains details about the response
	 * Fields: format, lang
	 * Note: This is a dynamic object (stdClass)
	 *
	 * @var object
	 */
	protected $response = NULL;

	/**
	 * List of allowed HTTP methods
	 *
	 * @var array
	 */
	protected $allowed_http_methods = array('get', 'delete', 'post', 'put', 'options', 'patch', 'head');

	/**
	 * List all supported methods, the first will be the default format
	 *
	 * @var array
	 */
	protected $_supported_formats = array(
		'json' => 'application/json',
		'array' => 'application/json',
		'csv' => 'application/csv',
		'html' => 'text/html',
		'jsonp' => 'application/javascript',
		'php' => 'text/plain',
		'serialized' => 'application/vnd.php.serialized',
		'xml' => 'application/xml'
	);

	// Constructor
	public function __construct()
	{


		// router info
		/*$this->request = new stdClass();
		$this->request->module = $this->router->fetch_module();
		$this->request->class = $this->router->fetch_class();
		//$this->request->method = $this->router->fetch_method();
		$this->request->method = $this->_detect_method();*/

		//$this->request = new stdClass();
		$this->mModule = $this->router->fetch_module();
		$this->mClass = $this->router->fetch_class();
		//$this->request->method = $this->router->fetch_method();
		$this->mMethod = $this->_detect_method();




		parent::__construct();
	}

	// Setup values from file: config/ci_bootstrap.php
	private function _setup()
	{

	}

	/**
	 * Get the HTTP request string e.g. get or post
	 *
	 * @access protected
	 * @return string|NULL Supported request method as a lowercase string; otherwise, NULL if not supported
	 */
	protected function _detect_method()
	{
		// Declare a variable to store the method
		$method = NULL;

		// Determine whether the 'enable_emulate_request' setting is enabled
		if ($this->config->item('enable_emulate_request') === TRUE) {
			$method = $this->input->post('_method');
			if ($method === NULL) {
				$method = $this->input->server('HTTP_X_HTTP_METHOD_OVERRIDE');
			}

			$method = strtolower($method);
		}

		if (empty($method)) {
			// Get the request method as a lowercase string
			$method = $this->input->method();
		}

		// return in_array($method, $this->allowed_http_methods) && method_exists($this, '_parse_' . $method) ? $method : 'get';
		return in_array($method, $this->allowed_http_methods) ? $method : 'get';
		//return $method;
	}


	/**
	 * Requests are not made to methods directly, the request will be for
	 * an "object". This simply maps the object and method to the correct
	 * Controller method
	 *
	 * @access public
	 * @param string $object_called
	 * @param array $arguments The arguments passed to the controller method
	 */
	public function _remap($object_called, $arguments = array())
	{

		// Remove the supported format from the function name e.g. index.json => index
		$object_called = preg_replace('/^(.*)\.(?:' . implode('|', array_keys($this->_supported_formats)) . ')$/', '$1', $object_called);

		$controller_method = $object_called . '_' . $this->mMethod;
		// Does this method exist? If not, try executing an index method
		if (!method_exists($this, $controller_method)) {
			//$controller_method = "index_" . $this->request->method;
			//$controller_method = "index";
			//array_unshift($arguments, $object_called);
			$this->accessDenied();
		}


		// Call the controller method and passed arguments
		try {
			call_user_func_array(array($this, $controller_method), $arguments);
		} catch (Exception $ex) {
			// If the method doesn't exist, then the error will be caught and an error response shown
			$_error = &load_class('Exceptions', 'core');
			$_error->show_exception($ex);
		}
	}

	protected function accessDenied()
	{
		echo "Request is not allowed";
		exit();
	}


	/**
	 * Takes mixed data and optionally a status code, then creates the response
	 *
	 * @access public
	 * @param array|NULL $data Data to output to the user
	 * @param int|NULL $http_code HTTP status code
	 * @param bool $continue TRUE to flush the response to the client and continue
	 * running the script; otherwise, exit
	 */
	public function response($data = NULL, $http_code = null, $message = null)
	{
		// If the HTTP status is not NULL, then cast as an integer
		if ($http_code !== NULL) {
			// So as to be safe later on in the process
			$http_code = (int)$http_code;
		}

		// If data is NULL and no HTTP status code provided, then display, error and exit
		if ($data === NULL) {
			$http_code = self::HTTP_NOT_FOUND;
		}

		$output = null;

		if ($data) {
			$output = $data;
		}else{
			$output = new stdClass();
			$output->error = new stdClass();
			$output->error->code = $http_code;

			if (!empty($message)) {
				$output->error->message = $message;
			}
		}

		// set response code - 200 OK
		http_response_code($http_code);
		echo json_encode($output);
	}


}
