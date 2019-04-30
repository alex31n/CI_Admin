<?php

class User_model extends MY_Model
{

	public function __construct()
	{
		$this->has_one['users_groups'] = array('users_groups_model', 'user_id', 'id');

		$this->config->load('ax_table');
		$config = $this->config->item('ax_table');
		$this->table = $config['table']['users'];

		parent::__construct();
	}

	public function get_users_with_groups()
	{
		/*$users = $this->order_by(array('id' => 'ASC'))
			->get_all('id');*/
		$users = $this->db->select('id, first_name, last_name, username, email, phone, active')
			->from('users')
			->get()
			->result();

		foreach ($users as $user) {
			$user->groups = $this->get_groups_name($user->id)->name;

		}

		return $users;

	}

	public function get_groups_name($user_id)
	{
		return $this->db->select('GROUP_CONCAT(g.name SEPARATOR \', \') as name')
			->where('ug.user_id', $user_id)
			->join('groups g', 'ug.group_id=g.id', 'left')
			->get('users_groups ug')->first_row();
	}
	public function get_groups($user_id)
	{
		return $this->db->select('g.id, g.name')
			->where('ug.user_id', $user_id)
			->join('groups g', 'ug.group_id=g.id', 'left')
			->get('users_groups ug')->result();
	}




}
