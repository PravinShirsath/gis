<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompaniesController extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		//$this->load->library(array('session', 'form_validation'));
		//$this->load->database();
			$this->load->model('Company');
	}

	public function index()
	{
	
	}
	public function create()
	{
		/* $companies['companies']= $this->Company->fetch_record('companies');
		$data=array('companies'=>$companies); */
		$this->load->view('Companies/create');
	}

		public function activelist()
	{
		$companies['companies']= $this->Company->fetch_record('companies');
		$data=array(
			'companies'=>$companies
					);
		$this->load->view('Companies/activelist',$data);
	}
	
	public function deactivatelist()
	{
		$companies['companies']= $this->Company->fetch_deactiverecord('companies');
		$data=array(
			'companies'=>$companies
					);
		$this->load->view('companies/deactivatelist',$data);
	}

	
	public function store()
	{
		if(isset($_POST['Save']))
		{
			$data = array(
			'name'=>$this->input->post('name'),			 
			'active'=>'1',
			'created_at'=>date('Y-m-d H:i:s'),
			);

				$companies = $this->db->get_where('companies',array('name'=>$_POST["name"]));
				$companies = $companies->row();
				if(isset($companies))
				{
				echo $name = $companies->name; 
				if($name == $_POST['name'])
				{	
					echo "<script>alert('This COMPANY already Exists..!');</script>";
					echo "<META http-equiv='refresh' content='0;URL=create'>";
				} 
				}						
				else
				{
			$insert = $this->Company->insert($data);
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
			$upt=$this->db->update('companies');
			echo "<script>alert('Record Updated Successfully..!');</script>";
			echo "<META http-equiv='refresh' content='0;URL=create'>";	
		}
			
	//Redirect('CompaniesController/create');
	}
	public function edit($id)
	{
		$companies['companies']= $this->Company->fetch_record('companies');
		$singlecompanys['singlecompanys']= $this->Company->fetch_where($id);
		$data=array(
		          'companies'=>$companies,
		          'singlecompanys'=>$singlecompanys
					);
		$this->load->view('Companies/create',$data);
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
		$this->db->update('companies');
		Redirect('CompaniesController/create');
	}
	
		public function activatecompany()
		{
			$placeId = $_POST['post_id'];
			$this->db->set( array(
				'active'=>1
				));
			$this->db->where('id', $placeId);
			$this->db->update('companies');
			Redirect('CompaniesController/create');
		}
}
