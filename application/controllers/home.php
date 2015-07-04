<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();	
        
        $this->load->helper(array('form', 'url', 'file'));
		$this->load->library('form_validation', 'upload');
		$this->load->model('m_lostfound');
		
		session_start();
    }

	public function index() {
		$this->load->view('home');
	}
	
	public function lost($category="all") {
		$this->lost_found("lost");
	}
	
	public function found($category="all") {
		$this->lost_found("found");
	}

	public function post() {		
		$this->load->view('post');
	}
	
	private function lost_found($table) {
		$results = $this->m_lostfound->get_stuff($table);
//		var_dump($results);
		$data = array( 'data' => $results);
		$this->load->view('lost_found', $data);
	}

}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */