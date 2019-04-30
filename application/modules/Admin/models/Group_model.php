<?php

class Group_model extends MY_Model{

	public function __construct()
	{

		$this->config->load('ax_table');
		$config = $this->config->item('ax_table');
		$this->table = $config['table']['groups'];

		parent::__construct();
	}

}
