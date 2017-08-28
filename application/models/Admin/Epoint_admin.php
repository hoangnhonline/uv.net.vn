  
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'Admin.php';
class Epoint_admin extends Admin {
	function __construct(){
		parent::__construct();
		$this->layout         =   "admin/layout/admin/";	
        $this->component      =   "component/admin/";
	}
	function dashboard(){
        $this->load->model("Company",           "company");
 
        $companys       = $this->company->get_list_for_admin();
        $select         = "*";

        return array(
            "companys"          =>  $companys,
            "select"            =>  $select,
            "component"         =>  $this->component,
        );
    
	}
    function map(){
        return array(
            "component"         =>  $this->component,
        );
    }
    function defalt_url(){
        return base_url() . "admin/dashboard";
    }
    function user(){
        $this->load->model("Company",           "company");
        $this->load->model("User",           "user");

        $users  =   $this->user->query("select distinct user.*, company_name from user, company where user.company_id = company.id");
        $companies = $this->company->query("select * from company");

        $select         = "*";
        return array(
            "company_id"        =>  $this->info->company_id,
            "users"             =>  $users,
            "companies"         =>  $companies,
            "select"            =>  $select,
            "component"         =>  $this->component,
        );
    }
    function shop(){
        $this->load->model("Shop", "shop");
        $this->load->model("Make_sql", "make_sql");

        $sidebar = array();
        $conditions = $this->db->query("select * from select_condition order by col_order")->result();

        foreach ($conditions as $key => $value) {
            $sidebar[] = array(
                "value" =>  $this->db->query("select * from shop_" . $value->name . " order by col_order")->result(),
                "display_name"  =>  $value->display_name,
                "name"          =>  $value->name
                );
        }

        $shop_type =    array(
            "value"             => $this->db->query("select * from shop_type order by col_order")->result(),
            "display_name"      => "Danh mục cửa hàng",
            "name"              =>  "type"
            );

        
        $sql = $this->make_sql->get_shops_sql(0, 200);
        
        $shops = $this->shop->query($sql);


        return array(
            "sidebar"           =>  $sidebar,
            "shop_type"         =>  $shop_type,
            "shops"             =>  $shops,
            "component"         =>  $this->component,
        );
    }
    function config(){
        $sidebar = array();
        $conditions = $this->db->query("select * from select_condition order by col_order")->result();

        foreach ($conditions as $key => $value) {
            $sidebar[] = array(
                "value" =>  $this->db->query("select * from shop_" . $value->name . " order by col_order")->result(),
                "display_name"  =>  $value->display_name,
                "name"          =>  $value->name
                );
        }

        $shop_type =    array(
            "value"             => $this->db->query("select * from shop_type order by col_order")->result(),
            "display_name"      => "Danh mục cửa hàng",
            "name"              =>  "type"
            );


        return array(
                "sidebar"           =>  $sidebar,
                "shop_type"         =>  $shop_type,
                "conditions"        =>  $conditions,
                "component"         =>  $this->component,
            );
        echo "<pre>";
            print_r($shop_type["value"]);
        echo "</pre>";
    }
}