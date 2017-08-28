
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'Admin.php';
class View_admin extends Admin {
	function __construct(){
		parent::__construct();
		$this->layout         =   "admin/layout/view/";	
        $this->component      =   "component/view/";
	}
    function defalt_url(){
        return base_url() . "admin/shop";
    }
	function shop(){
        $this->load->model("Shop", "shop");
        $shops = $this->shop->get_view_shop($this->user->get_user_info()->id);

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