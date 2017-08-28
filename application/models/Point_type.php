<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'application/models/Model.php';
class Point_type extends Model {

	function __construct(){
		parent::__construct();
		$this->table = 'shop_type';
		$this->key = 'id';
		$this->order = array('id', 'desc');
		$this->select = '*';
		$this->foreign_key = '';
	}

}