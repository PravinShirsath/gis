<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->check_isvalidated();
    }	
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function LoginPage()
	{
		$this->load->view('LoginPage');
	}
	 private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('LoginController');
        }
    }
}
