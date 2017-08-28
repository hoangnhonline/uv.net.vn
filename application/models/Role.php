
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'application/models/Model.php';
class Role extends Model {


	function __construct(){
		parent::__construct();
		$this->table = 'role';
		$this->key = 'id';
		$this->order = array('id', 'asc');
		$this->select = '*';
	}
}