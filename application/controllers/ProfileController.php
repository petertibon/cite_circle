<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation','email','Aauth','upload', 'session'));
		$this->load->helper(array('url','form','date'));
		$this->load->model('profile_model');
		$this->load->database();
	}
	
	
	public function index()
	{
		if($this->aauth->is_loggedin())
		{
			$this->load->view('profile');
		}
		else
		{
			$data['body'] = 'login_view';
			$this->load->view('template/template', $data);
		}	
	}
	
	
	
	public function view_profile()
	{
		if($this->aauth->is_loggedin())
		{
			$data['user_profile'] = $this->profile_model->getUserInfo();
			$this->load->view('profile_view', $data);
	
		}
		else
		{
			$data['body'] = 'login_view';
			$this->load->view('template/template', $data);
		}
	
	}
	
	

	public function edit()
	{
		
		$this->load->view('edit');
		
	}
	
	
	
	public function edit_profile()
	{
	
		$this->form_validation->set_rules('firstname', 'First name' ,'required');
		$this->form_validation->set_rules('lastname', 'Last name' ,'required');
		$this->form_validation->set_rules('birthday','Birthday', 'required');
		$this->form_validation->set_rules('contact_number', 'Contact number', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('age', 'Age', 'required');
	
		if($this->form_validation->run() == FALSE)
		{
			$this->view_profile();
		}
		else
		{
	
			$user_id = $this->session->userdata('id');
			$user_firstname = $this->input->post('firstname');
			$user_lastname= $this->input->post('lastname');
			$user_birthday = $this->input->post('birthday');
			$user_age= $this->input->post('age');
			$user_contact= $this->input->post('contact_number');
			$user_address = $this->input->post('address');
			$user_gender = $this->input->post('gender');
				
			$data = array(
	
					'user_id' => $user_id,
					'firstname' => $user_firstname,
					'lastname' => $user_lastname,
					'birthday' => $user_birthday,
					'age' => $user_age,
					'contact_number' => $user_contact,
					'address' => $user_address,
					'gender' => $user_gender
			);
				
			$this->profile_model->insertUserInfo($data);
			$this->view_profile();
		}
	
	}
	
	
	
	public function update()
	{
	
		$data['user_profile'] = $this->profile_model->getUserInfo();
		$this->load->view('update', $data);
	
	}

	
	
	public function update_account()
	{
		$this->form_validation->set_rules('username' ,'User name', 'required|min_length[4]');
		$this->form_validation->set_rules('password','Password', 'required|min_length[6]');
		$this->form_validation->set_rules('email','Email','required|valid_email');
	
		if($this->form_validation->run() == FALSE)
		{
			echo "false";
		}
		else
		{
			$user_id = $this->session->userdata('id');
			$user_name = $this->input->post('username');
			$user_email= $this->input->post('email');
			$user_password = $this->input->post('password');
	
			$data = array(
						
					'id' => $user_id,
					'name' => $user_name,
					'pass' => $user_password,
					'email' => $user_email
						
			);
			$this->profile_model->updateAccountInfo($data);
				
			echo "true";
		}
	}
	
	
	public function update_profile()
	{
	
		$this->form_validation->set_rules('firstname', 'First name' ,'required');
		$this->form_validation->set_rules('lastname', 'Last name' ,'required');
		$this->form_validation->set_rules('birthday','Birthday', 'required');
		$this->form_validation->set_rules('contact_number', 'Contact number', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('age', 'Age', 'required');
	
		if($this->form_validation->run() == FALSE)
		{
			echo "false";
		}
		else
		{
	
			$user_id = $this->session->userdata('id');
			$user_firstname = $this->input->post('firstname');
			$user_lastname= $this->input->post('lastname');
			$user_birthday = $this->input->post('birthday');
			$user_age= $this->input->post('age');
			$user_contact= $this->input->post('contact_number');
			$user_address = $this->input->post('address');
			$user_gender = $this->input->post('gender');
	
			$data = array(
	
					'user_id' => $user_id,
					'firstname' => $user_firstname,
					'lastname' => $user_lastname,
					'birthday' => $user_birthday,
					'age' => $user_age,
					'contact_number' => $user_contact,
					'address' => $user_address,
					'gender' => $user_gender
			);
	
			$this->profile_model->updateUserInfo($data);
			echo "true";
		}
	
	}
	
	
	
	public function check_user()
	{
		 $username = $this->input->post('name');
		 
		 $result = $this->profile_model->check_user_exist($username);
		 
		 if($result)
		 {
		  echo "false";
		 }
		 else
		 {
		  echo "true";
		 }
		 
	}
	
	public function check_pass()
	{
		$password = $this->input->post('password');
		$result = $this->profile_model->check_pass_exist($password);
			
		if($result)
		{
			echo "false";
		}
		else
		{
			echo  "true";
		}
		
	}
	
	public function check_email()
	{
		
		$email = $this->input->post('email');
		$result = $this->profile_model->check_email_exist($email);
			
		if($result)
		{
			echo "false";
		}
		else
		{
			echo "true";
		}
		
	}
	

	
	/* public function do_upload(){
	
	$config = array(
	'upload_path' => "./uploads/img",
	'allowed_types' => "gif|jpg|png|jpeg|pdf",
	'overwrite' => TRUE,
	'max_height' => "768",
	'max_width' => "1024"
	);
	
	$this->upload->initialize($config);
	$this->load->library('upload', $config);
	
	if($this->upload->do_upload())
	{
	redirect();
	}
	else
	{
	$error = array('error' => $this->upload->display_errors());
	$this->load->view('profile_view', $error);
	}
	} */

}
	

