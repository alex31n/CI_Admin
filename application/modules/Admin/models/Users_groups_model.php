<?php

class Users_groups_model extends MY_Model
{

	public function __construct()
	{
		$this->has_one['groups'] = array('group_model', 'id', 'group_id');

		$this->config->load('ax_table');
		$config = $this->config->item('ax_table');
		$this->tables= $config['table'];
		$this->table = $config['table']['users_groups'];

		parent::__construct();
	}


	public function get_user_groups($user_id){
		$group = $this->db->select('g.id, g.name')
			->where('ug.user_id',$user_id)
			->from($this->table.' ug')
			->join($this->tables['groups'] .' g', 'g.id = ug.group_id')
		->get();

		return $group->result();
	}
}
