<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Controller extends CI_Controller {

    protected $info = null;

    public function __construct(){
        parent::__construct();
    	$this->load->database();
        $this->load->library("session");
        $this->load->helper('url');
        
    }
}
