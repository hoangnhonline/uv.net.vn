<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model extends CI_Model {
		
	var $table = 'admin';
	var $key = 'id';	
	var $order = array('id', 'desc');	
	var $select = '*';
	var $foreign_key = '';

	function pre_dump($var){
		echo "<pre><code>";
		var_dump($var);
		echo "</pre></code>";
	}

	function get_foreign_key(){
		return $this->foreign_key;
	}
	function get_list($input = array()) {
		$this->db->select($this->select);	    
		$this->get_list_set_input($input);
				
		$query = $this->db->get($this->table);		
		return $query->result();
	}
	function create($data = array()) {
		if($this->db->insert($this->table, $data))
		{
		   return TRUE;
		}else{
			return FALSE;
		}
	}

	function insert_id($data = array()) {
			$this->db->insert($this->table, $data);
			$id = $this->db->insert_id();
			return $id;
	}
	function update($id, $data) {
		if (!$id)
		{
			return FALSE;
		}
		
		$where = array();
	 	$where[$this->key] = $id;
	    $this->update_rule($where, $data);
	 	
	 	return TRUE;
	}
	protected function get_list_set_input($input = array()) {
		if ((isset($input['select'])) && $input['select'])
		{
			$this->db->select($input['select']);
		}

		if ((isset($input['where'])) && $input['where'])
		{
			$this->db->where($input['where']);
		}
						
	    if ((isset($input['like'])) && $input['like'])
		{
			$this->db->like($input['like'][0], $input['like'][1]); 
		}
						
		if (isset($input['order'][0]) && isset($input['order'][1]))
		{
			$this->db->order_by($input['order'][0], $input['order'][1]);
		}
		else
		{			
			$order = ($this->order == '') ? array($this->table.'.'.$this->key, 'desc') : $this->order;
			$this->db->order_by($order[0], $order[1]);
		}
						
		if (isset($input['limit'][0]) && isset($input['limit'][1]))
		{
			$this->db->limit($input['limit'][0], $input['limit'][1]);
		}
	}
	protected function query($sql){
		$rows = $this->db->query($sql);
		return $rows->result();
	}
	function update_rule($where, $data)
	{
		if (!$where)
		{
			return FALSE;
		}
		
	 	$this->db->where($where);
	 	$this->db->update($this->table, $data);

	 	return TRUE;
	}
	function delete($id)
	{
		if (!$id)
		{
			return FALSE;
		}
		//neu la so
		if(is_numeric($id))
		{
			$where = array($this->key => $id);
		}else
		{
		    //$id = 1,2,3...
			$where = $this->key . " IN (".$id.") ";
		}
	 	$this->del_rule($where);
		
		return TRUE;
	}
	function del_rule($where)
	{
		if (!$where)
		{
			return FALSE;
		}
		
	 	$this->db->where($where);
		$this->db->delete($this->table);
	 
		return TRUE;
	}
	function get_info($id, $field = '')
	{
		if (!$id)
		{
			return FALSE;
		}
	 	
	 	$where = array();
	 	$where[$this->key] = $id;
	 	
	 	return $this->get_info_rule($where, $field);
	}
	function get_info_rule($where = array(), $field= '')
	{
	    if($field)
	    {
	        $this->db->select($field);
	    }
		$this->db->where($where);
		$query = $this->db->get($this->table);
		if ($query->num_rows())
		{
			return $query->row();
		}
		
		return FALSE;
	}
	function get_total($input = array())
	{
		$this->get_list_set_input($input);
		
		$query = $this->db->get($this->table);
		
		return $query->num_rows();
	}
	function get_sum($field, $where = array())
	{
		$this->db->select_sum($field);//tinh rong
		$this->db->where($where);//dieu kien
		$this->db->from($this->table);
		
		$row = $this->db->get()->row();
		foreach ($row as $f => $v)
		{
			$sum = $v;
		}
		return $sum;
	}
	function get_row($input = array()){
		$this->get_list_set_input($input);
		
		$query = $this->db->get($this->table);
		
		return $query->row();
	}

    function check_exists($where = array())
    {
	    $this->db->where($where);
	    //thuc hien cau truy van lay du lieu
		$query = $this->db->get($this->table);
		
		if($query->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	
}
?>