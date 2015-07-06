<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_lostfound extends CI_Model {

	var $max_idle_time = 300; // allowed idle time in secs

    function __construct() {
        parent::__construct();
    }
    
	function save( $table, $user_data ) {
		$this->db->insert($table , $user_data); 
		return $this->db->insert_id();
	}
	
	function update( $table, $user_data ) {
		if (isset($user_data['id'])) {
			$this->db->where('id', $user_data['id'] );
			$this->db->update( $table , $user_data); 
			return $this->db->affected_rows();
		}
		return false;
	}
	
	// get user by username
	function get_stuff( $table ) {
//		$query = "select * from " .$table. " limit " .$this->offsets[$table]. "," .$this->limit;
		$query = "select * from " .$table;
		$result = $this->db->query($query);
		if( $result->num_rows() > 0 ) {
			return $result->result_array();
		}
		return false;
	}
	
	function get_details( $table, $image) {
		$query = $this->db->get_where($table, array('image' => $image), 1);
		if( $query->num_rows() > 0 ) return $query->row_array();
		return false;
	}
	
	function get_max_id($table) {
		//doesn't help if certain row deleted
// 		$query = $this->db->get($table);
// 		return $query->num_rows();
		$this->db->select_max('id');
		$query = $this->db->get($table);
		$result = $query->result_array();
		$id = array_values($result)[0]['id'];
		
//http://stackoverflow.com/questions/239136/fastest-way-to-convert-string-to-integer-in-php
		return 1 + $id;	
	}
	
}

/* End of file m_user.php */
/* Location: ./application/models/m_user.php */