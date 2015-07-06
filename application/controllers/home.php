<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Home extends CI_Controller {

    function __construct() {
        parent::__construct();	
        
        $this->load->helper(array('form', 'url', 'file'));
		$this->load->library(array('form_validation', 'upload', 'session'));
		$this->load->model('m_lostfound');

		// The controller constructor will be called for each client request		
//		session_start();
//		session_unset();
//		$session_data = array(
// 			'last_activity' => '',
// 			'logged_in' => '',
// 			'user' => '',
//			'username' => '',
//			'active-nav' => 'home'
//		);
//		$this->session->set_userdata($session_data);

		if ( $this->session->userdata('active-nav') == NULL) {
			$this->session->set_userdata('active-nav', 'home');
		}
		
    }

	public function index() {
		$this->load->view('home');
	}
	
	public function lost($category="all") {
		$this->session->set_userdata('active-nav', 'lost');
		$this->lost_found("lost");
	}
	
	public function found($category="all") {
		$this->session->set_userdata('active-nav', 'found');
		$this->lost_found("found");
	}

	public function post($category="lost") {		
		$data = array( 'table' => $category);
		$this->session->set_userdata('active-nav', 'post');
		$this->load->view('post', $data);
	}
	
	private function lost_found($table) {
		$results = $this->m_lostfound->get_stuff($table);
//		var_dump($results);
		//wrap the results in another array
		$data = array( 'data' => $results, 'table' => $table);
		$this->load->view('lost_found', $data);
	}
	
	public function show_details($table='lost', $image='') {
//		var_dump($image);
		$results = $this->m_lostfound->show_details($table, $image);
		$this->load->view('show_details', array('data' => $results) );
	}

}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */