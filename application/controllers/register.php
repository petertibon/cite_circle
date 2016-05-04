<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// Your own constructor code
		$this->load->library("Aauth");
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	
	public function index(){
		$data['body'] = 'register_view'; // cal your content
		$this->load->view('template/template', $data);
	}
	
	/**
	 * register function.
	 *
	 * @access public
	 * @return void
	 */
	public function register() {
		// set validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
	
		if ($this->form_validation->run() === false) {
				
			// validation not ok, send validation errors to the view
			$data['body'] = 'register_view'; // cal your content
			$this->load->view('template/template', $data);
				
		} else {
				
			// set variables from the form
			$name = $this->input->post('name');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			
			if ($this->aauth->create_user($email,$password,$name) == true) {
	
				$data['body'] = 'register_success'; // cal your content
				$this->load->view('template/template', $data);
	
			} else {
				// send error to the view
				$data['error'] = $this->aauth->print_errors();
				
				$data['body'] = 'register_view'; // cal your content
				$this->load->view('template/template', $data);
			}
				
		}
	
	}
	

	
}