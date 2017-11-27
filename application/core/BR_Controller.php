<?php

require_once APPPATH . '/libraries/REST_Controller.php';


class BR_Controller extends REST_Controller {

	public function __construct() {
		parent::__construct();
		// date_default_timezone_set('UTC');
		// $this->validate_authorization(1);
		// $this->db->insert('aa_manager_api', array('api_name' => uri_string(),
		// 		'post' 			=> json_encode($this->post()),
		// 		'image' 		=> json_encode($_FILES),
		// 		'get' 			=> json_encode($this->get()),
		// 		'access_token' 	=> $this->access_token,
		// 		'ctime'			=> time()
		// ));
	}
	
	protected function create_error($code, $message = '') {
		$response = array();
		if ($message != '')
			$message = ': ' . $message;
		$message = $this->getErrorMessage($code) . $message;
		$response = array('code' => $code,
				'message' => $message,
				'data' => null);
		$this->response($response, 200);
	}
	
	protected function create_success($data, $message = 'Success') {
		if ($this->input->get_request_header('Devicetype') == 'Android') {
			if ($data == null) {
				$response = array(); 
			} else {
				$response = $data;
			}
			$response['code'] = 0;
		} else {
			$response = array();
			$response['code'] = 0;
			$response['message'] = $message;
			$response['data'] = $data;
		}
	
		$this->response($response, 200);
	}
	
	private function getErrorMessage($code) {
		if (array_key_exists($code, $this->error_array))  {
			return $this->error_array[$code];
		}
		return $this->error_array[-1000];
	}
	
	private $error_array = array(
			1 => 'Warming',
			-1 	=> 'Missing data field required',
			-2 	=> 'System error',
			-3 	=> 'Database error',
			-4 	=> 'Username or password invalid',
			-79 => 'Followed',
			-1000 	=> 'Undefine error',
			-1001 	=> 'Apikey invalid',
			-1002 	=> 'Your account have beed deactived!',
			-1003	=> "Access denied.",
			-1005 	=> 'Unknow resource',
		);
	
	public function c_getNotNull($key) {
		$value = $this->post($key, '');
		if ($value == '')
			$this->create_error(-1, $key);
		return $value;
	}
	
	public function c_getWithLength($key, $to, $from = 0) {
		$value = $this->post($key, '');
		if (strlen($value) > $to || strlen($value) < $from)
			$this->create_error(-8, $key . ' lenght from ' . $from . ' to ' . $to);
		return $value;
	}
	
	public function c_getNumberNotNull($key) {
		$value = $this->post($key, '');
		if ($value == '')
			$this->create_error(-1, $key);
		if (!validate_number($value))
			$this->create_error(-8, $key . ' must be a number');
		return 1 * $value;
	}
	
	public function c_getNumberBetween($key, $from, $to) {
		$value = $this->post($key, '');
		if ($value == '')
			$this->create_error(-1, $key);
		if (!validate_number($value))
			$this->create_error(-8, $key);
		$value = $value * 1;
		if ($value < $from || $value > $to)
			$this->create_error(-8, $key . ' must from ' . $from . ' to ' . $to);
		return $value;
	}
	
	public function c_getEmail($key) {
		$value = $this->post($key, '');
		if ($value == '')
			$this->create_error(-1, $key);
		if (!validate_email($value))
			$this->create_error(-8, $key);
		return  $value;
	}
	
	public function c_getOnlyContainNumber($key) {
		$value = $this->post($key, '');
		if ($value == '')
			$this->create_error(-1, $key);
		if (!validate_number($value))
			$this->create_error(-8, $key);
		return $value;
	}
	
	public function __checkMentioned($content, $user_id) {
		$usernames = getUsernameCanbe($content);
		$usernames = array_map('strtoupper', $usernames);
		if (count($usernames) > 0) {
			$sql = 'select user_id, user_name from user where upper(user_name) IN ("'.implode('", "', $usernames).'") AND status = 1 AND user_id != '.$user_id;
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				return $query->result_array();
			}
		}
		return null;
	}
}
