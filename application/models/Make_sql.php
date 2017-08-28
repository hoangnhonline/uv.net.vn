<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'application/models/Model.php';
class Make_sql extends Model {


	function __construct(){
		parent::__construct();
		$this->table = 'select_condition';
		$this->key = 'id';
		$this->order = array('id', 'asc');
		$this->select = '*';
	}

	function get_sql($where, $start = 0, $limit = 10000){
		$conditions = $this->get_list();
		if(strlen($where) >= 3)
			$where = " AND " . $where;

		$sql = "";
		$reference = "
			shop.condition_id 		= 	shop_select_condition.id AND
			shop.user_id			= 	user.id AND 
			shop.status 			= 	1 AND 
			shop.type_id 			=	shop_type.id AND
			shop_type.status 		= 	1 
		";

		$reference .= $where;

		$from = "shop, shop_select_condition, user, shop_type";
		$select = "	
					shop.id as shop_id, 
					shop.full_address,
					shop.shop_name,
					shop.phone,
					shop.namer,
					shop.type_id,
					shop.location,
					user.fullname,
					shop_select_condition.*
		";

		$limit = $start . ", " . $limit;
		foreach ($conditions as $row) {
			$reference .= " AND shop_select_condition." . $row->name . "_id = shop_" . $row->name . ".id";
			$from .= ", shop_" . $row->name;
			$select .= ", shop_" . $row->name . ".id as " . $row->name . "_id";
		}
		$sql = "select " . $select . " from " . $from . " where " . $reference . " limit " . $limit;


		return $sql;
	}
	function get_sql_has_company($where, $start = 0, $limit = 10000){
		$conditions = $this->get_list();
		if(strlen($where) >= 3)
			$where = " AND " . $where;

		$sql = "";
		$reference = "
			shop.condition_id 		= 	shop_select_condition.id AND
			shop.user_id			= 	user.id AND
			shop.status 			= 	1 AND 
			shop.type_id 			=	shop_type.id AND
			shop_type.status 		= 	1
		";

		$reference .= $where;

		$from = "shop, shop_select_condition, user, shop_type";
		$select = "	
					shop.id as shop_id, 
					shop.full_address,
					shop.shop_name,
					shop.phone,
					shop.namer,
					shop.type_id,
					shop.location,
					user.fullname
		";

		$limit = $start . ", " . $limit;
		foreach ($conditions as $row) {
			$reference .= " AND shop_select_condition." . $row->name . "_id = shop_" . $row->name . ".id";
			$from .= ", shop_" . $row->name;
			$select .= ", shop_" . $row->name . ".id as " . $row->name . "_id";
		}
		$sql = "select " . $select . " from " . $from . " where " . $reference . " limit " . $limit;


		return $sql;
	}

	function get_shops_sql($page = 0, $limit = 1){
		$start = $page * $limit;
		$from = "shop, user, company";
		$select = "	
					shop.id,
					shop.full_address,
					shop.shop_name,
					shop.phone,
					shop.namer,
					company.company_name,
					shop.status
		";
		$reference = "shop.user_id = user.id and user.company_id = company.id";
		$limit = $start . ", " . $limit;
		$sql = "select " . $select . " from " . $from . " where " . $reference . " limit " . $limit;
		return $sql;
	}

	function get_shop_sql($id){
		$conditions = $this->get_list();

		$where = "";

		$sql = "";
		$reference = "
			shop.condition_id 		= 	shop_select_condition.id AND
			shop.user_id			= 	user.id AND
			user.company_id			= 	company.id AND
			shop_id 				=	" . $id . "
		";

		$reference .= $where;

		$from = "shop, shop_select_condition, user, company";
		$select = "	
					shop.id as shop_id, 
					shop.full_address,
					shop.shop_name,
					shop.phone,
					shop.namer,
					shop.user_id,
					shop.type_id,
					shop.location,
					shop.status,
					company.company_name,
					shop.condition_id
		";

		foreach ($conditions as $row) {
			$reference .= " AND shop_select_condition." . $row->name . "_id = shop_" . $row->name . ".id";
			$from .= ", shop_" . $row->name;
			$select .= ", shop_" . $row->name . ".id as " . $row->name . "_id";
		}
		$sql = "select " . $select . " from " . $from . " where " . $reference;


		return $sql;
	}
	function get_group_sql($id){
		return "select group_user.*, user.fullname, user.id as user_id from user, group_user where group_user.id = " . $id . " and group_user.id = user.group_user_id and user.type <> " . COMPANY;
	}

	function custom_search($slug, $user_id){
		return "select 
			location,
			phone,
			shop_name,
			namer,
			url,
			concat(address, ', ', street, ', ', ward.name, ', ', district.name, ', ', province.name) as address
		from
			shop,
			image,
			district,
			ward,
			province
		where 
			shop.district_id = district.id AND
			shop.province_id = province.id AND
			shop.ward_id = ward.id AND
			image.shop_id = shop.id AND
			shop.slug like '%" . $slug . "%' AND
			shop.user_id = " . $user_id . "
		";
	}
}