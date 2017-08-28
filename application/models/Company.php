<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'application/models/Model.php';
class Company extends Model {
	function __construct(){
		parent::__construct();
		$this->table = 'company';
		$this->key = 'id';
		$this->order = array('option_value', 'asc');
		$this->select = 'id as option_key, company_name as option_value';
	}

	function get_list_for_admin()
	{
		$this->db->select("*");
		return $this->db->get($this->table)->result();
	}

	function delete($id)
	{
		if($id == 0) return;
		$type = $this->session->userdata("user")->type;
		if($type >= 1 && $type <= 2){			
			$this->db->query("delete from company where id = " . $id);
			$this->db->query("update shop set user_id = 1 where user_id in (select id from user where company_id = " . $id . ")");
			$this->db->query("delete from user where company_id = " . $id);
		}
	}
}