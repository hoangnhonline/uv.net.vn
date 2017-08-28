<?php

	require_once 'application/controllers/Controller.php';
    require_once 'application/controllers/Upload.php';
	class Action_controller extends Controller{
		public function __construct() {
			parent::__construct();
			if($this->session->userdata("user") == null){
				header("location: " . base_url("admin/login"));
				exit();
			} else {
	            $user_info = $this->session->userdata("user");

	            if ($user_info->type == ADMIN){

	                $this->load->model("Admin/Epoint_admin", "user");
	            } else if ($user_info->type == OPERATOR){

	                $this->load->model("Admin/Operator_admin", "user");
	            } else if ($user_info->type == COMPANY){

	                $this->load->model("Admin/Company_admin", "user");
	            } else if ($user_info->type == SUPERVISOR){

	                $this->load->model("Admin/Supervisor_admin", "user");
	            } else if ($user_info->type == SALE){

	                $this->load->model("Admin/Sale_admin", "user");
	            } else if ($user_info->type == VIEW){

	                $this->load->model("Admin/View_admin", "user");
	            }
	            
	            $this->user->set_info($user_info);
	            $this->login = true;
			}
		}

		function index($action, $object){
			if($this->session->userdata("user")->type == VIEW)
				return;
			$method = $action . "_" . $object;
			if(method_exists($this, $method)){
				$this->$method();
			} else {
				echo "function undefined";
				return;
			}
		}


		function update_company(){
			$this->load->model("Company", "company");
			$this->load->model("User", "user_model");

			$company_info = array();
			if($ret = $this->input->post("company_name"))
				$company_info["company_name"] = $this->input->post("company_name");
			if($ret = $this->input->post("ftp_name"))
				$company_info["ftp_name"] = $this->input->post("ftp_name");
			if($ret = $this->input->post("ftp_pass"))
				$company_info["ftp_pass"] = $this->input->post("ftp_pass");
			if($ret = $this->input->post("ftp_host"))
				$company_info["ftp_host"] = $this->input->post("ftp_host");
			if($ret = $this->input->post("phone"))
				$company_info["phone"] = $this->input->post("phone");
			if($ret = $this->input->post("address"))
				$company_info["address"] = $this->input->post("address");
			if($ret = $this->input->post("manager_id"))
				$company_info["manager_id"] = $this->input->post("manager_id");


			$id = $this->input->post("id");

			$info = $this->db->query("select manager_id from company where id = " . $id)->result();

			if(count($info) == 1 && $id != 0) {
				$manager_id = $info[0]->manager_id;
				$this->user_model->update($manager_id, array("type"	=>	SALE));

				if($new_manager_id = $this->input->post("manager_id"))
					$this->user_model->update($new_manager_id, array("type"	=>	COMPANY));
			}

			$this->company->update($id, $company_info);
			header("location: " . base_url("admin/company"));
		}

		function add_company(){
            
			$this->load->model("Company", "company");
			$this->load->model("User", "user");

			$manager_info = array();
			if($ret = $this->input->post("fullname"))
				$manager_info["fullname"] = $this->input->post("fullname");
			if($ret = $this->input->post("username"))
				$manager_info["username"] = $this->input->post("username") . "_" . time();
			if($ret = $this->input->post("email"))
				$manager_info["email"] = $this->input->post("email");
			if($ret = $this->input->post("phone"))
				$company_info["phone"] = $this->input->post("phone");
			if($ret = $this->input->post("password"))
				$manager_info["password"] = md5($this->input->post("password"));
			
			$manager_info["type"] = COMPANY;

			try {
				$id = $this->user->insert_id($manager_info);
			} catch (Exception $e) {
				echo "username exits. try another username<br>";
				echo "<a href='" . base_url("admin/user") . "'>Click here</a>";
				return;
			}

			if($id > 0){

				$company_info = array();
				if($ret = $this->input->post("company_name"))
					$company_info["company_name"] =  	$this->input->post("company_name");
				if($ret = $this->input->post("ftp_name"))
					$company_info["ftp_name"] =  	$this->input->post("ftp_name");
				if($ret = $this->input->post("ftp_pass"))
					$company_info["ftp_pass"] =  	$this->input->post("ftp_pass");
				if($ret = $this->input->post("ftp_host"))
					$company_info["ftp_host"] = $this->input->post("ftp_host");
				if($ret = $this->input->post("phone"))
					$company_info["phone"] =  	$this->input->post("phone");
				if($ret = $this->input->post("address"))
					$company_info["address"] =  	$this->input->post("address");
				if($ret = $id)
					$company_info["manager_id"] = 	$id;
				
				$company_id = $this->company->insert_id($company_info);

				$this->user->update($id, array("company_id"	=>	$company_id));

				header("location: " . base_url('admin'));
				return true;
			} else {
				header("location: " . base_url('admin'));
				return false;
			}

		}

		function add_group(){
			$data = $this->input->post();
			$data["company_id"]	= $this->user->get_user_info()->company_id;
			$this->db->insert("group_user", $data);
			$id = $this->db->insert_id();
			$this->db->update("user", array("group_user_id" =>	$id, "type"	=>	SUPERVISOR), "id = " . $data["manager_id"]);
			header("location: " . base_url('admin/group'));
		}
		function update_group(){
			$data = $this->input->post();

			$this->db->update("group_user", $data, "id = " . $data["id"]);

			$this->db->update("user", array("type"	=>	SALE), "group_user_id = " . $data["id"] . " and type = " . SUPERVISOR);
			$this->db->update("user", array("type"	=>	SUPERVISOR), "id = " . $data["manager_id"]);
			
			header("location: " . base_url('admin/group'));
		}

		function update_user(){
			$this->load->model("User", "user");

			$user_info = array();
			if($ret = $this->input->post("fullname"))
				$user_info["fullname"] =  	$this->input->post("fullname");
			if($ret = $this->input->post("email"))
				$user_info["email"] =  	$this->input->post("email");
			if($ret = $this->input->post("phone"))
				$user_info["phone"] = 	$this->input->post("phone");
			if($ret = $this->input->post("group_user_id"))
				$user_info["group_user_id"] = 	$this->input->post("group_user_id");

			$user_info["company_id"] = 	($this->input->post("company_id") == null) ? $this->user->get_user_info()->company_id : $this->input->post("company_id");
			
			if(strlen($this->input->post("password")) >= 1)
				$user_info["password"]	= 	 md5($this->input->post("password"));
			$id = $this->input->post("id");
			$this->user->update($id, $user_info);
			header("location: " . base_url('admin/user'));
		}

		function add_user(){
			$this->load->model("User", "user_model");
			$user_info = array();
			if($ret = $this->input->post("fullname"))
				$user_info["fullname"] = $this->input->post("fullname");
			if($ret = $this->input->post("username"))
				$user_info["username"] = $this->input->post("username") . "_" . time();
			if($ret = $this->input->post("email"))
				$user_info["email"] = $this->input->post("email");
			if($ret = $this->input->post("password"))
				$user_info["password"] = md5($this->input->post("password"));
			if($ret = $this->input->post("type"))
				$user_info["type"] = $this->input->post("type");
			if($ret = $this->input->post("phone"))
				$user_info["phone"] = $this->input->post("phone");
			if($ret = $this->input->post("phone"))
				$user_info["phone"] = $this->input->post("phone");


			$user_info["company_id"] =	($this->input->post("company_id") == null) ? $this->user->get_user_info()->company_id : $this->input->post("company_id");

			try {
				$id = $this->user_model->insert_id($user_info);
				header("location: " . base_url('admin/user'));
			} catch (Exception $e) {
				echo "username exits. try another username<br>";
				echo "<a href='" . base_url("admin/user") . "'>Click here</a>";
			}
		}

		function update_select(){

			$id = $this->input->post("id");
			$select = array(
				"type"	=>	$this->input->post("type"),
				"col_order"	=>	$this->input->post("col_order"),
				"color"	=>	$this->input->post("color"),
			);
			$table = "shop_" . $this->input->post("table");
			if(is_numeric($id)){
				$this->db->update($table, $select, "id=" . $id);
			} else {
				$this->db->insert($table, $select);
			}
			header("location: " . base_url("admin/config"));
		}
		function delete_select(){
			$id = $this->input->post("id");
			$table = "shop_" . $this->input->post("table");
			if(is_numeric($id)){
				$this->db->delete($table, array("id"	=>	$id));
			}
			header("location: " . base_url("admin/config"));
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
		function to_slug2($str) {
		    $str = trim(mb_strtolower($str));
		    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
		    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
		    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
		    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
		    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
		    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
		    $str = preg_replace('/(đ)/', 'd', $str);
		    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
		    $str = preg_replace('/([\s]+)/', '_', $str);
		    return $str;
		}
		function add_condition(){
			
			$display_name = $this->input->post("type");
			$name = $this->to_slug2($display_name . "_" . time());
			$col_order = $this->input->post("col_order");
			$table = "shop_" . $name;
			$column = $name . "_id";

			$add_column_sql = 'ALTER TABLE `shop_select_condition` ADD `' . $column . '` TINYINT NOT NULL DEFAULT "1"';
			$add_condition_sql = 'INSERT INTO `select_condition` (`id`, `name`, `display_name`, `col_order`) VALUES (NULL, "' . $name . '", "' . $display_name . '", "' . $col_order . '")';

			$create_table_sql = 'CREATE TABLE ' . $table . ' ( `id` TINYINT NOT NULL AUTO_INCREMENT , `type` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , `color` VARCHAR(10) NOT NULL , `col_order` TINYINT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB';
			

			$this->db->query($add_column_sql);
			$this->db->query($add_condition_sql);
			$this->db->query($create_table_sql);

			header("location: " . base_url("admin/config"));
		}
		function update_condition(){
			$id = is_numeric($this->input->post("id")) ? ($this->input->post("id") * 1) : 0;
			if($id){
				$condition_info = array(
					"display_name"	=>	$this->input->post("display_name"),
					"col_order"	=>	$this->input->post("col_order"),
				);
				$this->db->update("select_condition", $condition_info, "id = ". $id);
			}
			header("location: " . base_url("admin/config"));
		}
		function delete_condition(){
			$id = is_numeric($this->input->post("id")) ? ($this->input->post("id") * 1) : 0;
			if($id){
				try {
					$rows = $this->db->query("select name from select_condition where id = " . $id)->result();
					$this->db->query("DROP TABLE shop_" . $rows[0]->name);
					$this->db->query("ALTER TABLE `shop_select_condition` DROP `" . $rows[0]->name . "_id`");
					$this->db->query("delete from select_condition where id = " . $id);
				} catch (Exception $e) {
					
				}
			}
			header("location: " . base_url("admin/config"));
		}
		function check_status(){
			$this->db->query("update shop_type set status = (status + 1) % 2 where id = " .$this->input->post("id"));
			header("location: " . base_url("admin/config"));
		}
		function update_shop(){

			
			$id = is_numeric($this->input->post("id")) ? ($this->input->post("id")) : 0;
			$condition_id = is_numeric($this->input->post("condition_id")) ? ($this->input->post("condition_id")) : 0;

			if($id > 0 && $condition_id > 0){
				$shop_info = array(
					"shop_name"	=>	$this->input->post("shop_name"),
					"namer"	=>	$this->input->post("namer"),
					"status"	=>	($var = $this->input->post("status")) ? 1 : 0,
					"full_address"	=>	$this->input->post("full_address"),
					"phone"	=>	$this->input->post("phone"),
					"type_id"	=>	$this->input->post("type_id"),
					"slug"	=>	$this->to_slug($this->input->post("shop_name")) . " " . $this->to_slug($this->input->post("full_address"))
				);

				$select_conditions = $this->db->query("select name from select_condition")->result();

				$shop_select_condition_info = array();
				foreach ($select_conditions as $key => $value) {
					$shop_select_condition_info[$value->name . "_id"] = $this->input->post($value->name . "_id");
				}
				$this->load->model("Shop", "shop");
				$this->shop->update($id, $shop_info);
				$this->db->update("shop_select_condition", $shop_select_condition_info, "id = " . $condition_id);
			}
			if($this->input->post("url"))
				header("location: " . $this->input->post("url"));
			else
				header("location: " . base_url("admin/shop"));
		}

		function update_location(){
			$id = $this->input->post("id");
			if(is_numeric($id) && $id > 0){
				$shop_location = array(
					"location"	=>	$this->input->post("lat") . "," . $this->input->post("long"),
				);
				$this->load->model("Shop", "shop");
				$this->shop->update($id, $shop_location);
				return 1;
			}
			return 0;
		}

		public function add_type(){

            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');

            $config['upload_path']          = './assets/images/map-icons/';
            $config['allowed_types']        = 'png|gif|jpg';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload("icon_url"))
            {
                //$data = array('error' => $this->upload->display_errors());

                //$this->load->view('upload_form', $error);
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $this->form_validation->set_rules('type', '', 'required');
                $this->form_validation->set_rules('col_order', '', 'required');
                $this->form_validation->set_rules('icon_url', '', 'required');

                $type_info = array(
                    'type' => $this->input->post("type"),
                    'col_order' => $this->input->post("col_order"),
                    'icon_url'  => "assets/images/map-icons/".$data['upload_data']['file_name']
                );

                $this->db->insert('shop_type', $type_info);
            }


            header("location: " . base_url("admin/config"));
		}

        public function update_type(){
            $id = is_numeric($this->input->post("id")) ? ($this->input->post("id") * 1) : 0;

            if($id){
                $query = $this->db->get_where('shop_type',array('id'=>$id));
                if( $query->num_rows() > 0 ){
                    $this->load->helper(array('form', 'url'));
                    $this->load->library('form_validation');


                    $config['upload_path']          = './assets/images/map-icons/';
                    $config['allowed_types']        = 'png|gif|jpg';
                    $config['max_size']             = 100;
                    $config['max_width']            = 1024;
                    $config['max_height']           = 768;
                    $config['overwrite']            = TRUE;
                    $config['file_name']            = $id;


                    $this->load->library('upload', $config);
                    $this->form_validation->set_rules('type', '', 'required');
                    $this->form_validation->set_rules('col_order', '', 'required');

                    if ( ! $this->upload->do_upload("icon_url"))
                    {
                        $this->db->select('icon_url');
                        $this->db->where('id', $id);
                        $q = $this->db->get('shop_type');
                        $data = $q->result_array();
                        $icon_url = $data[0]['icon_url'];

                    }
                    else
                    {
                        $data = array('upload_data' => $this->upload->data());
                        $icon_url = "assets/images/map-icons/".$id.$data['upload_data']['file_ext'];
                    }

                    $type_info = array(
                        'type' => $this->input->post("type"),
                        'col_order' => $this->input->post("col_order"),
                        'icon_url'  => $icon_url
                    );

                    $this->db->where('id', $id);
                    $this->db->update('shop_type', $type_info);
                }
            }

            header("location: " . base_url("admin/config"));
        }

        public function delete_user()
        {
        	$this->load->model("User", "user_model");
        	if($this->input->post("id") != 1)
        		$this->user_model->delete($this->input->post("id"));
        	header("location: " . base_url("admin/user"));
        }

        public function delete_shop()
        {
        	$this->load->model("Shop", "shop_model");
        	$this->shop_model->delete($this->input->post("id"));
        	header("location: " . base_url("admin/shop"));
        }

        public function delete_company()
        {
        	$this->load->model("Company", "company_model");
        	if($this->input->post("id") != 0)
        		$this->company_model->delete($this->input->post("id"));
        	header("location: " . base_url("admin/company"));
        }
	}

?>