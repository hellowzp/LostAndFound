<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();	
        
        $this->load->helper(array('form', 'url', 'file'));
		$this->load->library('form_validation', 'upload');
		$this->load->model('m_lostfound');
		
		session_start();
		$_SESSION['active-nav'] = 'home';
    }

	public function index() {
		$this->load->view('home');
	}
	
	public function lost($category="all") {
		$_SESSION['active-nav'] = 'lost';
		$this->lost_found("lost");
	}
	
	public function found($category="all") {
		$_SESSION['active-nav'] = 'found';
		$this->lost_found("found");
	}

	public function post($category="lost") {		
		$data = array( 'table' => $category);
		$_SESSION['active-nav'] = 'post';
		$this->load->view('post', $data);
	}
	
	private function lost_found($table) {
		$results = $this->m_lostfound->get_stuff($table);
//		var_dump($results);
		//wrap the results in another array
		$data = array( 'data' => $results, 'table' => $table);
		$this->load->view('lost_found', $data);
	}
	
	public function show_details($image='') {
		
	}

}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */