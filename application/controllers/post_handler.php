<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_Handler extends CI_Controller {
		
    function __construct() {
        parent::__construct();
        
        $this->load->library('form_validation');
        $this->load->model('m_lostfound');
        $this->load->helper('security');

        $this->data = array();    
        
        $config ['upload_path'] = base_url() . 'img';
        $config ['allowed_types'] = 'gif|jpg|jpeg|png';
        $config ['max_size'] = '4096';  //KB
        $config ['max_width'] = '1920';
        $config ['max_height'] = '1080';
        
        $this->load->library ( 'upload', $config );
    }

	public function index() {
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
		$this->form_validation->set_rules('image', "Image", 'callback_upload_file_check');

		$this->data['table'] = $this->input->post('type');
		$this->data['db'] = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'image' => $this->input->post('image'),
			'date' => $this->input->post('date'),
			'location' => $this->input->post('location'),
			'email' => $this->input->post('email')
		);
		
		if ($this->form_validation->run()) {			
			// ensure the file name is unique by adding a id prefix
			// and remove all special characters to make it safe for url request
			$rows = $this->m_lostfound->get_max_id($this->data['table']);
			$this->data['db']['image'] = $rows . '_'
				. preg_replace('/[^A-Za-z0-9\.]/', '', $this->data['db']['image']);
					
			$source_temp = $_FILES['imgFile']['tmp_name'];
			//target must be file system path instead of url connection like http://domain/path
			$target_path = dirname( dirname( dirname(__FILE__) ) )
						 . '/img/uploads/'
						 . $this->data['db']['image'];
			
			if( move_uploaded_file($source_temp, $target_path)) {
				if ( $this->m_lostfound->save( $this->data['table'], $this->data['db']) ) {
					$this->data['success'] = 'Post Succeed! Click here to see your new '
										   . '<a href="' .site_url("home/".$this->data["table"])
										   . '">' . $this->data["table"] . '</a> post.';
				} else { 
					$this->data['error'] = 'Sorry, post failed. Please contact the administrator.'; 
				}	
			}		
		} 
		
		$this->load->view('post', $this->data);
	}
	
	public function upload_file_check() {
		$file = $_FILES['imgFile'];
		if( $file && $file['size'] > 4096000 ){
			$this->form_validation->set_message('upload_file_check', 'The allowed maximum image size is 4MB');
			return false;
		} 
		return true;
	}	
	
}