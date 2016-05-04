<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {
		parent::__construct();
		// Your own constructor code
		$this->load->library("Aauth");
	}
	
	public function index(){
	 	if ( $this->aauth->is_loggedin() ){
            $data['body'] = 'login_success'; // call your content
			$this->load->view('template/template', $data);
        } else {
            $data['body'] = 'home_view'; // call your content
			$this->load->view('template/template', $data);
        }
	}
	
}