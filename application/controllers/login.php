<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	// data for view, we do this so we can set value in __construct
	// and pass to other functions if needed
	var $data = array(); 
	
    function __construct() {
        // Call the Controller constructor
        parent::__construct();
		$this->load->model('m_user');
		$this->load->library('form_validation', 'session');
		
// 		if ( $this->session->userdata('redirect') == NULL) {
// 			echo var_dump( $this->session->all_userdata() );
// 			$this->session->set_userdata('redirect', 'home');
// 		}
    }

	// route /login
	public function index($redirect='home', $msg='') {
		if ($this->m_user->is_logged_in()) redirect($redirect);
		
		$this->data['login_success'] = urldecode($msg);
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run()) {
			unset($this->data['login_success']);
			$username = $this->input->post('username');
			$password = $this->input->post('password');
		
			if ($user = $this->m_user->get_by_username($username)) {
				if ($this->m_user->check_password( $password, $user['password'] )) {
					$this->m_user->allow_pass( $user );
					redirect('home');
				} else { 
					$this->data['login_error'] = 'Invalid username or password'; 
				}
			} else { 
				$this->data['login_error'] = 'Username not found'; 
			}
		}
		
		$this->data['redirect'] = $redirect;
		$this->load->view('login/v_login', $this->data);
	}
	
	// route /register -- check settings in /application/config/routes.php
	public function register($redirect='home') {
		if ($this->m_user->is_logged_in()) redirect($redirect);

		$this->form_validation->set_rules('fullname', 'Full Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('cpassword', 'Password', 'required|matches[password]');
		
		if ($this->form_validation->run()) {
			$user = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'fullname' => $this->input->post('fullname'),
				'password' => $this->m_user->hash_password( $this->input->post('password') )
			);
			if ( $this->m_user->save($user) ) {
				$this->data['register_success'] = 'Registration successful. <a href="'.site_url('login').'">Click here to login</a>.';
			} else { $this->data['register_error'] = 'Saving data failed. Contact administrator.'; }
		}
		
		$this->data['redirect'] = $redirect;
		$this->load->view('login/v_register', $this->data);
	}
	
	// route /logout -- check settings in /application/config/routes.php
	public function logout() {
		$this->m_user->remove_pass();
		$this->data['login_success'] = 'Thanks for your login.';
		$this->data['redirect'] = 'home';
		$this->load->view('login/v_login', $this->data);		
	}
	
	// noaccess to show no access message
	public function noaccess() {
		$this->data['login_error'] = 'You do not have access or your login has expired.';
		$this->data['redirect'] = 'home';
		$this->load->view('login/v_login', $this->data);
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */