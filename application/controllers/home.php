<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();	
        
        $this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
    }

	public function index() {
		$this->load->view('home');
	}
	
	public function lost($category="all") {
		$this->load->view('lost',$category);
	}
	
	public function found($category="all") {
		$this->load->view('found',$category);
	}

	public function post() {		
		$this->load->view('post');
	}

}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */