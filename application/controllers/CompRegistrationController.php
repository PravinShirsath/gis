<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompRegistrationController extends CI_Controller {
public function __construct()
{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		//$this->load->library(array('session', 'form_validation'));
		//$this->load->database();
		$this->load->model('CompRegistration');
}

	public function index()
	{
	
	}
	public function create()
	{
		$company['company']= $this->CompRegistration->fetch_record('companies');
		$office['office']= $this->CompRegistration->fetch_record('stateoffice');
		$data=array('company'=>$company, 'office'=>$office);

		$this->load->view('CompRegs/create', $data);
	}

	public function activelist()
	{
		$this->db->select ( 'compreg.*', 'companies.name as companyName', 'stateoffice.name as officeName'); 
		$this->db->from ( 'compreg' );
		$this->db->join ( 'companies', 'companies.id = compreg.companyId');
		$this->db->join ( 'stateoffice', 'stateoffice.id = compreg.officeId');
		$query = $this->db->get ();
		
		$company['company']= $this->CompRegistration->fetch_record('compreg');
		$data=array('company'=>$company);
		//print_r($data); die;
		$this->load->view('CompRegs/activelist',$data);
	}
	
	public function deactivatelist()
	{
		$company['company']= $this->CompRegistration->fetch_deactiverecord('compreg');
		$data=array(
			'company'=>$company
				    );
		$this->load->view('CompRegs/deactivatelist', $data);
	}

	
	public function store()
	{
		if(isset($_POST['Save']))
		{
			$data = array(
			'companyId'=>$this->input->post('compName'),
			'officeId'=>$this->input->post('OfficeName'),	
			'name'=>$this->input->post('name'),
			'designation'=>$this->input->post('designation'),
			'mobNumber'=>$this->input->post('Mobile'),		 
			'eMailId'=>$this->input->post('eMailId'),
			'parentId'=>$this->session->userdata('parentId'),	
			'created_at'=>date('Y-m-d'),
			);

				$comreg = $this->db->get_where('compreg',array('name'=>$_POST["name"]));
				$comreg = $comreg->row();

				if(isset($comreg))
				{
				echo $name = $comreg->name;
				if($name == $_POST['name'])
				{	
					echo "<script>alert('This Name already Exists..!');</script>";
					echo "<META http-equiv='refresh' content='0;URL=create'>";
				} 
				}						
				else
				{
			$insert = $this->CompRegistration->insert($data);
			echo "<script>alert('Record Inserted Successfully..!');</script>";
			echo "<META http-equiv='refresh' content='0;URL=create'>";
		}
		}
		elseif (isset($_POST['Edit']))
		{
			$this->db->set( array(
			'companyId'=>$this->input->post('compName'),
			'officeId'=>$this->input->post('OfficeName'),	
			'name'=>$this->input->post('name'),
			'designation'=>$this->input->post('designation'),
			'mobNumber'=>$this->input->post('Mobile'),		 
			'eMailId'=>$this->input->post('eMailId'),
			'parentId'=>$this->session->userdata('parentId'),	 
			'created_at'=>date('Y-m-d H:i:s')
			));
			$id=$_POST['id'];
			$this->db->where('id',$id);
			$upt=$this->db->update('compreg');
			echo "<script>alert('Record Updated Successfully..!');</script>";
			echo "<META http-equiv='refresh' content='0;URL=create'>";	
		}
			
	//Redirect('CompaniesController/create');
	}
	public function edit($id)
	{
		$company['company']= $this->CompRegistration->fetch_record('companies');
		$office['office']= $this->CompRegistration->fetch_record('stateoffice');
		$singlecompany['singlecompany']= $this->CompRegistration->fetch_where($id);
		$data=array('id'=>$id, 'singlecompany'=>$singlecompany, 'company'=>$company, 'office'=>$office);
		$this->load->view('CompRegs/create', $data);
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
		$this->db->update('compreg');
		Redirect('CompRegistrationController/create');
	}
	
		public function activatecompany()
		{
			$placeId = $_POST['post_id'];
			$this->db->set( array(
				'active'=>1
				));
			$this->db->where('id', $placeId);
			$this->db->update('compreg');
			Redirect('CompRegistrationController/create');
		}
}
