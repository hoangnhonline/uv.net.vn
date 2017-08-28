<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'Controller.php';
class HomeController extends Controller {

	function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->load->model("Province", 			"province");
		$this->load->model("Company", 			"company");

		$select_company 		= $this->load->view('component/user/select', array('selects' => $this->company->get_list()), true);
		$select_province 		= $this->load->view('component/user/select', array('selects' => $this->province->get_list()), true);


		$sidebar = array();
		$conditions = $this->db->query("select * from select_condition order by col_order")->result();

		foreach ($conditions as $key => $value) {
			$sidebar[] = array(
				"value"	=>	$this->db->query("select * from shop_" . $value->name . " order by col_order")->result(),
				"display_name"	=> 	$value->display_name,
				"name"			=> 	$value->name
				);
		}

		$shop_type =	array(
			"value"				=> $this->db->query("select * from shop_type order by col_order")->result(),
			"display_name"		=> "Danh mục cửa hàng",
			"name"				=> 	"type"
			);
		$edit_link = "";
		if($this->session->userdata("user") != null)
			$edit_link = base_url('admin/map/?id=');

		$this->load->view('home', array(
			'select_company' 				=> $select_company,
			'select_province' 				=> $select_province,
			'sidebar'						=> $sidebar,
			'edit_link'						=> $edit_link,
			'shop_type'						=> $shop_type,
		));

	}
}
