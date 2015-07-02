<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PostHandler extends CI_Controller {
	
    function __construct() {
        parent::__construct();
    }

	// route /login
	public function index() {
		$this->load->view('home');
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */