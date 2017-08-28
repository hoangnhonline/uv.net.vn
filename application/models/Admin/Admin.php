
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require_once 'application/models/User.php';
class Admin extends User {
	function __construct(){
		parent::__construct();
	}
}