<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalsezoneController extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		//$this->load->library(array('session', 'form_validation'));
		//$this->load->database();
			$this->load->model('Salsezone');
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
		$this->load->view('SalseZone/create');
	}

		public function activelist()
	{
		$SalseZone['SalseZone']= $this->Salsezone->fetch_record('salsezone');
		$data=array(
			'SalseZone'=>$SalseZone
					);
		
		$this->load->view('SalseZone/activelist',$data);
	}
	
	public function deactivatelist()
	{
		$SalseZone['SalseZone']= $this->Salsezone->fetch_deactiverecord('salsezone');
		$data=array(
			'SalseZone'=>$SalseZone
				    );
		$this->load->view('SalseZone/deactivatelist', $data);
	}

	
	public function store()
	{
		if(isset($_POST['Save']))
		{
			$data = array(
			'zonename'=>$this->input->post('zonename'),			 
			'parentid'=>$this->session->userdata('parentId'),			 
			'active'=>'1',
			'created_at'=>date('Y-m-d'),
			);

				$salsezone = $this->db->get_where('salsezone',array('zonename'=>$_POST["zonename"]));
				$salsezone = $salsezone->row();
				if(isset($salsezone))
				{
				echo $zonename = $salsezone->zonename; 
				if($zonename == $_POST['zonename'])
				{	
					echo "<script>alert('This ZONE already Exists..!');</script>";
					echo "<META http-equiv='refresh' content='0;URL=create'>";
				} 
				}						
				else
				{
			$insert = $this->Salsezone->insert($data);
			echo "<script>alert('Record Inserted Successfully..!');</script>";
			echo "<META http-equiv='refresh' content='0;URL=create'>";
		}
		}
		elseif (isset($_POST['Edit']))
		{
			$this->db->set( array(
			'zonename'=>$this->input->post('zonename'),		 
			'created_at'=>date('Y-m-d H:i:s')
			));
			$id=$_POST['id'];
			$this->db->where('id',$id);
			$upt=$this->db->update('salsezone');
			echo "<script>alert('Record Updated Successfully..!');</script>";
			echo "<META http-equiv='refresh' content='0;URL=create'>";	
		}
			
	//Redirect('CompaniesController/create');
	}
	public function edit($id)
	{
		$salsezone['salsezone']= $this->Salsezone->fetch_record('salsezone');
		$singlezone['singlezone']= $this->Salsezone->fetch_where($id);
		$data=array(
		          'id'=>$id,
		          'singlezone'=>$singlezone,
					);
		$this->load->view('SalseZone/create',$data);
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
		$this->db->update('salsezone');
		Redirect('SalsezoneController/create');
	}
	
		public function activatecompany()
		{
			$placeId = $_POST['post_id'];
			$this->db->set( array(
				'active'=>1
				));
			$this->db->where('id', $placeId);
			$this->db->update('salsezone');
			Redirect('SalsezoneController/create');
		}
}
