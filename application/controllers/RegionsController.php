<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegionsController extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->model('Region');
	}
	 
	public function create()
	{
		$regions['regions']= $this->Region->fetch_Record('regions');
		$data=array('regions'=>$regions );
		$this->load->view('Regions/create',$data);
	}
	
	public function activelist()
	{
		$regions['regions']= $this->Region->fetch_record('regions');
		$data=array(
			'regions'=>$regions
					);
		$this->load->view('Regions/activelist',$data);
	}
	
	public function deactivatelist()
	{
		$regions['regions']= $this->Region->fetch_deactiverecord('regions');
		$data=array(
			'regions'=>$regions
					);
		$this->load->view('Regions/deactivatelist',$data);
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
			$regions = $this->Region->checkregion($this->input->post('name'));			 
			if(!$regions)
			{
			 if( $this->Region->insert($data)){
				echo "<script>alert('Record Inserted Successfully..!');</script>";
				echo "<META http-equiv='refresh' content='0;URL=create'>";	
				}		 
			}						
			else
			{
				echo "<script>alert('This REGION already Exists..!');</script>";
				echo "<META http-equiv='refresh' content='0;URL=create'>";
			}
		}
		elseif(isset($_POST['Edit']))
		{
			$data = array(
			'name'=>$this->input->post('name')
			);
			$id=$_POST['id'];			
			if($this->Region->update($data,$id))
			{
			echo "<script>alert('Record Updated Successfully..!');</script>";
			echo "<META http-equiv='refresh' content='0;URL=create'>";	
			}
		}
					
	//Redirect('RegionsController/create');
	}	
	public function edit($id)
	{
		$regions['regions']= $this->Region->fetch_Record('regions');
		$singleRegion['singleRegion']= $this->Region->fetch_where($id);
		$data=array(
		          'regions'=>$regions,
		          'singleRegion'=>$singleRegion
					);
		$this->load->view('Regions/create',$data);
						
	}
	public function discard()
	{
		$placeId = $_POST['post_id'];
		$data=array('active'=>0);		 
		$this->Region->update($data,$placeId);
		Redirect('RegionsController/create');
	}	
	public function activateregion()
	{
		$placeId = $_POST['post_id'];
		$data=array('active'=>1);		 
		$this->Region->update($data,$placeId);
		Redirect('RegionsController/create');
	}
}
