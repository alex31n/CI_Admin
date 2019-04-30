<?php

class Api_model extends MY_Model{

	public function __construct()
	{
		$this->config->load('ax_table');
		$config = $this->config->item('ax_table');
		$this->table = $config['table']['api_keys'];
		//$this->table = 'api_keys';
		parent::__construct();


	}

}
