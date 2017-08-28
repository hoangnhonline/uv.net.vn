<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'application/controllers/Controller.php';

Class Get_controller  extends Controller{
	function __construct(){
		parent::__construct();

	}

	function get_shop_image($id) {
		$images = array();
		try {
			if(is_numeric($id)){
				$image_url = $this->db->query("select * from image where shop_id = " . $id)->result();
				if(count($image_url) == 1){
					$path = "UY_VIET_DINH_VI/" . $image_url[0]->url;
					if ($handle = opendir($path)) {
					    while (false !== ($entry = readdir($handle))) {

					        if ($entry != "." && $entry != "..") {
					        	$images[] = $image_url[0]->url . $entry;
					        }
					    }
					    closedir($handle);
					}
				}
			}
		} catch (Exception $e) {
			
		}
		echo json_encode($images);
	}

	function index($table = '', $foreign_key = '', $method = 'get_list'){
		try {
			$this->load->model($table, 'table');
		} catch (Exception $e) {
			echo "Not Found";
			return;
		}


		$where = array();
		$table_foreign_key = $this->table->get_foreign_key();

		if($foreign_key)
			if($table_foreign_key)
				$where[$table_foreign_key] = $foreign_key;


		echo json_encode(($this->table->$method(array("where" => $where))));
	}
	public function get_company_info($id){
		try {
			$this->load->model("Company", 'table');
		} catch (Exception $e) {
			echo "Not Found";
			return;
		}
		$ret = array();
		$ret["company_info"] 	= $this->db->query("select * from company where id = " . $id)->result();
		$ret["users"]			= $this->db->query("select id, fullname from user where company_id = " . $id)->result();
		echo json_encode($ret);
	}
	public function get_user_info($id){
		try {
			$this->load->model("User", 'table');
		} catch (Exception $e) {
			echo "Not Found";
			return;
		}
		$ret = array();

		$ret["user_info"] 	= $this->db->query("select fullname, email, phone, group_user_id from user where id = " . $id)->result();
		echo json_encode($ret);
	}
	public function check_user_permission($shop_info){
		$return = false;

		if(!($current_user = $this->session->userdata("user"))) return false;

		if($shop_info->user_id == $current_user->id){
			$return = true;
		} else if($current_user->type == ADMIN || $current_user->type == OPERATOR){
			$return = true;
		} else {
			$user = $this->db->query("select * from user where id = " . $shop_info->user_id)->result();
			if(count($user) == 1){
				if($current_user->type == COMPANY && $user[0]->company_id == $current_user->company_id)
					$return = true;
				else if($current_user->type == SUPERVISOR && $user[0]->group_user_id == $current_user->group_user_id)
					$return = true;
			}
		}
		return $return;
	}
	public function get_shop_info($id){
		$this->load->model("Make_sql", "make_sql");
		$sql = $this->make_sql->get_shop_sql($id);

		$shop_info = $this->db->query($sql)->result();
		if(count($shop_info) == 1){
			if($this->check_user_permission($shop_info[0])){
				echo json_encode($shop_info);
				return;
			}
		}

		echo json_encode(array());
	}
	public function get_group_info($id){
		$this->load->model("Make_sql", "make_sql");
		$sql = $this->make_sql->get_group_sql($id);

		$group_info = $this->db->query($sql)->result();
		echo json_encode($group_info);
	}

	function shoptype($action){

		//header("location: " . base_url("admin"));
	}
	function shoppotential($action){
		if(!$this->input->post("type") && !$this->input->post("color")){

			$this->load->model("Point_potential", "point_potential");
			if($action == "add"){
				$data = array(
					"type"				=> $this->input->post("type"),
					"color"				=> $this->input->post("color"),
				);
				$this->point_potential->create($data);
			} else if ($action == "del"){

			}
		}
		header("location: " . base_url("admin"));
	}
	function shopsize($action){
		if(!($this->input->post("size")) && !($this->input->post("color"))){

			$this->load->model("Point_size", "point_size");
			if($action == "add"){
				$data = array(
					"size"			=> $this->input->post("size"),
					"color"			=> $this->input->post("color"),
				);
				$this->point_size->create($data);
			} else if ($action == "del"){

			}
		}
		header("location: " . base_url("admin"));
	}
	function admin($function, $action){
		try {
			$func = str_replace("-", "_", $function);
			$this->$func($action);
		} catch (Exception $e) {
			header("location: " . base_url("admin"));
		}
	}
	function to_slug($str) {
	    $str = trim(mb_strtolower($str));
	    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
	    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
	    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
	    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
	    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
	    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
	    $str = preg_replace('/(đ)/', 'd', $str);
	    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
	    $str = preg_replace('/([\s]+)/', '-', $str);
	    return $str;
	}
	function custom_search(){
		if(($this->input->post("info"))){
			$data = json_decode($this->input->post("info"));
			$this->load->model("Make_sql", "make_sql");
			// $slug = $this->to_slug($name);
			// echo "<pre>";
			// var_dump($this->db->query($this->make_sql->custom_search($slug, 1))->result());
			// echo "</pre>";
			$slug = $this->to_slug($data->shop_name);
			echo json_encode($this->db->query($this->make_sql->custom_search($slug, $data->user_id))->result());
		} else {
			echo json_encode("Incorrect data");
		}
	}
	function add_point(){
        if(($this->input->post("info"))){
            $obj = json_decode($this->input->post("info"));
	        $this->load->model("Shop", 'shop');
	        $this->load->model("Image", 'image');

	        $shop_info = array();

	        if(isset($obj->shopname))
	        	$shop_info["shop_name"]	=	$obj->shopname;

	        if(isset($obj->namer))
	        	$shop_info["namer"]	=	$obj->namer;

	        if(isset($obj->address))
	        	$shop_info["address"]	=	$obj->address;

	        if(isset($obj->street))
	        	$shop_info["street"]	=	$obj->street;

	        if(isset($obj->location))
	        	$shop_info["location"]	=	$obj->location;
	        
	        if(isset($obj->phone))
	        	$shop_info["phone"]	=	$obj->phone;
	        
	        if(isset($obj->ward_id))
	        	$shop_info["ward_id"]	=	$obj->ward_id;
	        
	        if(isset($obj->district_id))
	        	$shop_info["district_id"]	=	$obj->district_id;
	        
	        if(isset($obj->province_id))
	        	$shop_info["province_id"]	=	$obj->province_id;
	        
	        if(isset($obj->type_id))
	        	$shop_info["type_id"]	=	$obj->type_id;
	        
	        if(isset($obj->user_id))
	        	$shop_info["user_id"]	=	$obj->user_id;


	        $shop_info["full_address"] = $shop_info["street"] . " " . $shop_info["address"];
	        
	        $shop_info["slug"] 			=	$this->to_slug($shop_info["shop_name"]) . " " . $this->to_slug($shop_info["street"]) . " " . $this->to_slug($shop_info["address"]);

	        
	        $id = $this->shop->insert_id($shop_info);
	        
	        $image_info = array("url"	=>	$obj->image, "shop_id"	=> 	$id);

	        $shop_select_condition = array("shop_id"	=>	$id);
	        $this->db->insert("shop_select_condition", $shop_select_condition);
	        $this->db->insert("image", $image_info);
	        echo json_encode("Successful");
        } else 
            echo json_encode("incorrect data");
	}
	function select(){
		try {
			$this->load->model('Shop', 'shop');
		} catch (Exception $e) {
			echo "Not Found";
			return;
		}

		$select_info = json_decode($this->input->post("select_info"));

		$location = "";
		$company = "";

		if(isset($select_info->location) && strlen($select_info->location) >= 7)
			$location = $select_info->location;

		if(isset($select_info->company) && strlen($select_info->company) >= 7)
			$company = $select_info->company;

		echo json_encode($this->shop->select($location, $company));
	}

	function search($shop_name){
		try {
			$this->load->model('Shop', 'shop');
		} catch (Exception $e) {
			echo "Not Found";
			return;
		}
		echo json_encode($this->shop->search($shop_name));
	}

	function ftp(){
        if(($this->input->post("info"))){
            $obj = json_decode($this->input->post("info"));
	        $ftp_info = $this->db->query('select ftp_name, ftp_pass from user, company where user.company_id = company.id and username = "' . $obj->username . '" and password = "' . md5($obj->password) . '"')->result();
	        if(count($ftp_info) != 1) {
	            echo json_encode("username or password incorrect");
	            return null;
	        }
	        echo json_encode($ftp_info);
        } else 
            echo json_encode("incorrect data");
	}
}

?>
