<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: thanhdo
 * Date: 10/20/16
 * Time: 12:08 PM
 */
require_once 'application/controllers/Controller.php';

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if(($user_info = $this->session->userdata("user"))){
            header("location: " . base_url("admin"));
        }

    }

    public function index(){
        $info = $this->input->post("info");
        if(isset($info)){
            $obj = json_decode($this->input->post("info"));
            $this->check_login($obj);
        } else 
            $this->login();
    }
    public function login(){
        $this->load->view('admin/login');
    }

    public function check_login($obj){
    	$this->load->model("User", "user");
        $info = array(
            "username"  => $obj->username,
            "password"  => md5($obj->password),
        );
        $user_info = $this->user->set_user_info($info);
        if(count($user_info) != 1) {
            //echo json_encode("username or password incorrect");
            return null;
        }
        
        $this->session->set_userdata("user", $user_info[0]);
        echo json_encode($user_info);
    }
}