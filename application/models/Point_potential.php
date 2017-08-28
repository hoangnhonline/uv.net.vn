<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'application/models/Model.php';
class Point_potential extends Model {

	function __construct(){
		parent::__construct();
		$this->table = 'shop_potential';
		$this->key = 'id';
		$this->order = array('id', 'desc');
		$this->select = '*';
		$this->foreign_key = '';
	}
}