<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	var $data = array();

    function __construct()
    {
        // Call the Controller constructor
        parent::__construct();	

    }

	public function index()
	{
		$this->load->view('home');
	}

	public function post() {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->load->view('post');
	}

}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */