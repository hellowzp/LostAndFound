<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {

	var $offsets;    // should ba saved in user-specific session
	var $limit = 5;  // mysql query limit
	var $max_idle_time = 300; // allowed idle time in secs

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $offsets = array( 'lost' => 0, 'found' => 0 );
    }
    
	// Save a new user. 
	function save( $table, $user_data ) {
		$this->db->insert($table , $user_data); 
		return $this->db->insert_id();
	}
	
	// Update an existing user
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
		$query = "select * from " $table . " limit " . $offsets[$table] . "," . $limit;
		$result = $this->db->query($query);
		$rows = $result->num_rows(); 
		if( $rows > 0 ) {
			$offsets[$table] += rows;
			return $result->result_array();
		}
		return false;
	}
	
}

/* End of file m_user.php */
/* Location: ./application/models/m_user.php */