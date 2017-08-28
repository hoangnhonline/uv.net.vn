<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'application/models/Model.php';
class Shop extends Model {

	function __construct(){
		parent::__construct();
		$this->table = 'shop';
		$this->key = 'id';
		$this->order = array('id', 'desc');
		$this->select = '*';
		$this->foreign_key = '';
	}
	function search($shop_name){
		$where = 'shop.slug like "%' . $shop_name . '%"';
        $this->load->model("Make_sql", "make_sql");
		$sql = $this->make_sql->get_sql($where, 0, 10000);
		return $this->query($sql);
	}

	function get_shop(){
        $this->load->model("Make_sql", "make_sql");
		$sql = $this->make_sql->get_sql("", 0, 20000);
		return $this->query($sql);
	}

	function get_sale_shop($user_id){
		$sql = "select * from shop where user_id = " . $user_id . " limit 0, 100";
		return $this->query($sql);
	}
	function get_view_shop($user_id){
		$sql = "select * from shop where user_id = " . $user_id . " limit 0, 100";
		return $this->query($sql);
	}
	function get_company_shop($company_id){
		$sql = "select shop.* from shop, user where shop.user_id = user.id and user.company_id = " . $company_id . " limit 0, 100";
		return $this->query($sql);
	}
	function get_supervisor_shop($group_id){
		$sql = "select shop.*, user.fullname from shop, user where shop.user_id = user.id and user.group_user_id = " . $group_id . " limit 0, 100";

		return $this->query($sql);
	}
	function select($location, $company){
		$where = "";
		if($location == "" && $company == ""){

		} else if($location != "" && $company != ""){
			$where = $location . " AND " . $company;
		} else 
			$where = $location . $where;


    	$this->load->model("Make_sql", "make_sql");
		if($company == "")
			$sql = $this->make_sql->get_sql($where, 0, 20000);
        else 
			$sql = $this->make_sql->get_sql_has_company($where, 0, 20000);
		return $this->query($sql);
	}

	function delete($id)
	{
		$type = $this->session->userdata("user")->type;
		if($type >= 1 && $type <= 5)
			$this->db->query("delete from shop where id = " . $id);
	}
}