<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'application/models/Model.php';
class District extends Model {

	function __construct(){
		parent::__construct();
		$this->table = 'district';
		$this->key = 'id';
		$this->order = array('option_value', 'asc');
		$this->select = 'id as option_key, concat(type, " ", name) as option_value';
		$this->foreign_key = 'province_id';
	}

}