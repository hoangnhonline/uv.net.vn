
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'Admin.php';
class Company_admin extends Admin {
	function __construct(){
		parent::__construct();
		$this->layout 		= 	"admin/layout/company/";
        $this->component    = "component/company/";
	}
    function map(){
        return array(
            "component"         =>  $this->component,
        );
    }
    function user(){
        $this->load->model("Company",           "company");
        $this->load->model("User",           "user");


        $users  =   $this->user->query("select user.* from user, company where user.type <> " . COMPANY . " and user.company_id = company.id and user.company_id = " . $this->info->company_id);
        $groups = $this->db->query("select * from group_user where company_id = " . $this->user->get_user_info()->company_id)->result();



        return array(
            "users"             =>  $users,
            "groups"       =>  $groups,
            "component"         =>  $this->component,
        );
    }
    function dashboard(){
    	header("location: " . base_url("admin/user"));
    	exit();
    }
    function group(){
        $users = $this->db->query("select user.id, fullname from user where user.company_id = " . $this->user->get_user_info()->company_id . " and user.id <> " . $this->user->get_user_info()->id)->result();

        $groups = $this->db->query("select group_user.* from group_user where group_user.company_id = " . $this->user->get_user_info()->company_id)->result();

        return array(
            "users"             =>  $users,
            "groups"             =>  $groups,
            "component"         =>  $this->component,
        );
    }
    function shop(){
        $this->load->model("Shop", "shop");
        $shops = $this->shop->get_company_shop($this->user->get_user_info()->company_id);

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
            "shops"             =>  $shops,
            "component"         =>  $this->component,
        );
    }
}