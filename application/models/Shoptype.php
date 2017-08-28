<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'application/models/Model.php';
class Shoptype extends Model {


	function __construct(){
		parent::__construct();
		$this->table = 'shop_type		';
		$this->key = 'id';
		$this->order = array('type', 'asc');
		$this->select = 'id, type';

	}

}