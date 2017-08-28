<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: thanhdo
 * Date: 10/29/16
 * Time: 10:54 AM
 */
require_once 'application/controllers/Controller.php';
class Administrator extends Controller
{
    private $login = false;
    public function __construct() {
        parent::__construct();

        if($this->session->userdata("user") == null){
            $this->login = false;
            header("location: " . base_url("admin/login"));
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

    public function index($file){
        if($this->login){
            $file = str_replace("-", "_", $file);
            try {
                if(method_exists($this->user, $file)) {
                    $data = $this->user->$file();

                    $layout = $this->user->get_layout() . $file;

                    $main_content = $this->load->view(
                        $layout, 
                        $data,
                        true
                    );

                    if($main_content == null)
                        return;
                    $this->load->view("admin/dashboard", array(
                        "main_content" => $main_content,
                    ));
                } else {
                    header("location:" . $this->user->defalt_url());
                }

            } catch (Exception $e) {
                header("location: " . $this->user->defalt_url());
            }
        }
    }


    public function signout(){
        $this->session->sess_destroy();
        header("location: " . base_url('admin/login'));
    }
}
