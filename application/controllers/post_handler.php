<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_Handler extends CI_Controller {
		
    function __construct() {
        parent::__construct();
        
        $this->load->library('form_validation');
        $this->load->model('m_lostfound');

        $this->data = array();    
        $this->img_ID = 1;
    }

	public function index() {
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email');
		
//		var_dump($_POST);

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
			if ( $this->m_lostfound->save($this->data['table'], $this->data['db']) ) {
				$this->data['success'] = 'Post Succeed! Click here to see your new <a href="'
					.site_url("home/".$this->data["table"]). '">'.$this->data["table"].'</a> post.';
			} else { 
				$this->data['error'] = 'Sorry, post failed. Please contact the administrator.'; 
			}			
		} 
		
		$this->load->view('post', $this->data);
	}
	
	public function do_upload() {
		$config ['upload_path'] = base_url() . 'img';
		$config ['allowed_types'] = 'gif|jpg|jpeg|png';
		$config ['max_size'] = '4096';  //KB
		$config ['max_width'] = '1024';
		$config ['max_height'] = '768';
		
		$this->load->library ( 'upload', $config );
		
		if (! $this->upload->do_upload ()) {
			$this->data['error'] = $this->upload->display_errors(); 
			$this->load->view ( 'post', $this->data );
		} else {
			$this->data['upload_data'] = $this->upload->data();
		}

		$this->load->view('post', $this->data);		
	}
	
	public function upload() {
		var_dump($_FILES);
		var_dump($_POST);
		$file = $_FILES['imgFile'];
		$file_name = ($this->img_ID++) . '_' . $file['name'];
		echo $file_name;
	}
}