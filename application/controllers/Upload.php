<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();

        }

        public function index()
        {
                $this->load->view('upload_form', array('error' => ' ' ));
        }

        public function do_upload($name_input = "userfile")
        {

        }
}
?>