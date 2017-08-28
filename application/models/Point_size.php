<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'application/models/Model.php';
class Point_size extends Model {

	function __construct(){
		parent::__construct();
		$this->table = 'shop_size';
		$this->key = 'id';
		$this->order = array('id', 'desc');
		$this->select = '*';
		$this->foreign_key = '';
	}
}