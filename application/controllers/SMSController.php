<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SMSController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database(); 
		$this->load->model('Association'); 
		$this->load->model('Login_model');
		$this->load->model('SendSMS');
	}	
	public function SingleSMS_create()
	{
		
	    $this->load->view('SMS/SingleSMS_create');
	}	
	public function AllSMS_create()
	{
		$this->load->view('SMS/AllSMS_create');
	}
	public function singlesms()
	{			 
			$sms=$this->input->post('singlesms');
			$SMSUser = 'sawasdee12345spa';
			$password = '123456';
			$sid = 'PETROA';
			$to = $this->input->post('mobile');
			$message=$sms;
			$sendSMS = $this->SendSMS->sendSMS($SMSUser, $password, $message, $to, $sid);	
			
			redirect('SMSController/SingleSMS_create');
	} 
	public function smsall()
	{		
			$parentId=$this->session->userdata('parentId');	
			$id=$this->input->post('id');
			$sms=$this->input->post('allsms');
			$SMSUser = 'sawasdee12345spa';
			$password = '123456';
			$sid = 'PETROA';			
			$message=$sms;		
			
			$this->db->select('mobileNo');
			$this->db->where('associationid',$parentId);
			$query=$this->db->get('pumps');
		
		foreach($query->result() as $row)
		{
			$to = $row->mobileNo; 
		    $sendSMS = $this->SendSMS->sendSMS($SMSUser, $password, $message, $to, $sid);	
		}	
	
		redirect('SMSController/AllSMS_create');
	} 
}
?>