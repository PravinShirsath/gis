<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StateOfficeController extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		//$this->load->library(array('session', 'form_validation'));
		//$this->load->database();
		$this->load->model('Stateoffice');
	}

	public function index()
	{
	
	}
	public function create()
	{
	/* 	
		$SalseZone['SalseZone']= $this->Salsezone->fetch_record('salsezone');
		$data=array(
			'SalseZone'=>$SalseZone
					);
		print_r($data);die; */
		$this->load->view('StateOffices/create');
	}

	public function activelist()
	{
		$stateoffice['stateoffice']= $this->Stateoffice->fetch_record('stateoffice');
		$data=array(
			'stateoffice'=>$stateoffice
					);
		
		$this->load->view('StateOffices/activelist',$data);
	}
	
	public function deactivatelist()
	{
		$stateoffice['stateoffice']= $this->Stateoffice->fetch_deactiverecord('stateoffice');
		//	print_r($stateoffice);die;
		$data=array('stateoffice'=>$stateoffice);
		$this->load->view('StateOffices/deactivatelist', $data);
	}

	
	public function store()
	{
		if(isset($_POST['Save']))
		{
			$data = array(
			'name'=>$this->input->post('name'),			 
			'parentid'=>$this->session->userdata('parentId'),			 
			'active'=>'1',
			'created_at'=>date('Y-m-d'),
			);
			//print_r($data);die;
				$statename = $this->db->get_where('stateoffice',array('name'=>$_POST["name"]));
				$stateoffice = $statename->row();
			if(isset($stateoffice))
			{
				$name = $stateoffice->name; 
				if($name == $_POST['name'])
				{	
					echo "<script>alert('This ZONE already Exists..!');</script>";
					echo "<META http-equiv='refresh' content='0;URL=create'>";
				} 
			}						
			else
			{
			$insert = $this->Stateoffice->insert($data);
			echo "<script>alert('Record Inserted Successfully..!');</script>";
			echo "<META http-equiv='refresh' content='0;URL=create'>";
			}
		}
		elseif (isset($_POST['Edit']))
		{
			$this->db->set( array(
			'name'=>$this->input->post('name'),		 
			'created_at'=>date('Y-m-d H:i:s')
			));
			$id=$_POST['id'];
			$this->db->where('id',$id);
			$upt=$this->db->update('stateoffice');
			echo "<script>alert('Record Updated Successfully..!');</script>";
			echo "<META http-equiv='refresh' content='0;URL=create'>";	
		}
			
	//Redirect('CompaniesController/create');
	}
	public function edit($id)
	{
		$stateoffice['stateoffice']= $this->Stateoffice->fetch_record('stateoffice');
		$singlestateoffice['singlestateoffice']= $this->Stateoffice->fetch_where($id);
		//print_r($singlestateoffice);die;
		$data=array('id'=>$id, 'singlestateoffice'=>$singlestateoffice);
					
		$this->load->view('StateOffices/create',$data);
	}
	public function update()
	{
	
	}
	public function discard()
	{
		$placeId = $_POST['post_id'];
		$this->db->set( array(
			'active'=>0
			));
		$this->db->where('id', $placeId);
		$this->db->update('stateoffice');
		Redirect('StateOfficeController/create');
	}
	
		public function activatecompany()
		{
			$placeId = $_POST['post_id'];
			$this->db->set( array(
				'active'=>1
				));
			$this->db->where('id', $placeId);
			$this->db->update('stateoffice');
			Redirect('StateOfficeController/create');
		}
}
