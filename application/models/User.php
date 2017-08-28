
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'application/models/Model.php';
class User extends Model {

	protected $info 		= null;
	protected $role 		= null;
	protected $layout 		= '';
	protected $component 	= '';
	function __construct(){
		parent::__construct();
		$this->table = 'user';
		$this->key = 'id';
		$this->order = array('id', 'asc');
		$this->select = '*';

	}

	function set_user_info($info){
		$sql = 'select user.* from user where username="' . $info["username"] .'" and password="' . $info["password"] . '"';
		return $this->query($sql);
	}
	function defalt_url(){
		return base_url() . "admin/user";
	}
	function get_user_info(){
		return $this->info;
	}

	function set_info($info){
		$this->info = $info;
	}

	function get_layout(){
		return $this->layout;
	}

	private function init_role(){
		if($this->info){
			try {
				$this->load->model("Role", "role_model");
				$where = array("user_id" 	=> $this->info->id);
				$this->role_model->get_list(array("where" 	=> 	$where));
			} catch (Exception $e) {
				
			}
		}
	}

	function check_role($role){
		if($role == null){
			$this->init_role();
		}

		if(!empty($this->role->$role)){
			return $this->role->$role;
		}

		return 0;
	}

	function delete($id)
	{
		if($id == 1) return;
		$type = $this->session->userdata("user")->type;
		if($type >= 1 && $type <= 3){			
			$this->db->query("delete from user where id = " . $id . " and type > " . $type);
			$this->db->query("update shop set user_id = 1 where user_id = " . $id);
		}
	}
}