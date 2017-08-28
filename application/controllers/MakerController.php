<?php

	/**
	* 
	*/
	class MakerController extends CI_Controller {
		
		public function getMakers(/*$db, $cols, $tables, $args = null, $order = null, $limit = null*/) {

			// $args = array(
			// 	'company.id = user.company_id',
			// 	'shop.user_id = user.id',
			// 	'shop.type_id = 1',
			// );
			// $tables = array(
			// 	'company',
			// 	'user',
			// 	'shop',
			// );
			// $cols = array(
			// 	'shop.*',
			// );
			// $select = implode($cols, ', ');

			// $from = implode($tables, ', ');
			// $where = '';
			// if($args != null){
			// 	$where = ' where (' . implode($args, ' ) and ( ') . ')';
			// }

			// $sql = 'select ' . $select . ' from ' . $from . $where;
			// echo $sql;



			$this->load->database();
			echo json_encode($this->db->query('select shop.*, icon_url from shop, shop_type where type_id = shop_type.id')->result());


		}
	}

?>