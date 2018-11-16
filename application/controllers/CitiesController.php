<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CitiesController extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		//$this->load->library(array('session', 'form_validation'));
		//$this->load->database();
		$this->load->model('City');
		$this->load->model('Region');
	}	 
	public function create()
	{
		$regions['regions']= $this->Region->fetch_Record('regions');		
		$data=array('regions'=>$regions);
		$this->load->view('Cities/create',$data);
	}	
	public function activelist()
	{
		$regions['regions']= $this->Region->fetch_Record('regions');
		$this->db->select('regions.name as regionname,cities.*');
		$this->db->from('cities', 'regions');
		$this->db->join('regions', 'cities.regionId = regions.id');	
		$this->db->where('cities.active',1);
		$result = $this->db->get();
		$cities['cities'] = $result->result();		
		$data=array('regions'=>$regions,'cities'=>$cities);
		$this->load->view('Cities/activelist',$data);
	}	
	public function deactivatelist()
		{
			$regions['regions']= $this->Region->fetch_Record('regions');
			$this->db->select('regions.name as regionname,cities.*');
			$this->db->from('cities', 'regions');
			$this->db->join('regions', 'cities.regionId = regions.id');	
			$this->db->where('cities.active', 0);					
			$result = $this->db->get();
			$cities['cities'] = $result->result();		
			$data=array('regions'=>$regions,'cities'=>$cities);
			$this->load->view('Cities/deactivatelist',$data);
		}	
	public function store()
	{
		if (isset($_POST['Save']))
		{
			$data = array(
				'name'=>$this->input->post('name'),
				'regionId'=>$this->input->post('region'),
				'active'=>'1',
				'created_at'=>date('Y-m-d H:i:s'),
				);
				if($this->City->insert($data)){
				echo "<script>alert('City added successfully..!');</script>";
				echo "<META http-equiv='refresh' content='0;URL=create'>";
				}
		}
		elseif (isset($_POST['Edit']))
		{
			$data=array(
				'name'=>$this->input->post('name'),
				'regionId'=>$this->input->post('region')				 
				);
				$id=$_POST['id'];				 
				if($this->City->update($data,$id))
				{
				echo "<script>alert('City Updated successfully..!');</script>";
				echo "<META http-equiv='refresh' content='0;URL=create'>";
				}
		}	
	}
	public function edit($id)
	{
		$regions['regions']= $this->Region->fetch_Record('Regions');		 
		$singlecities['singlecities']= $this->City->fetch_where($id);
		$data=array(
		          'regions'=>$regions,	           
		          'singlecities'=>$singlecities
					);
		$this->load->view('Cities/create',$data);
	}
	public function discard()
	{
		$placeId = $_POST['post_id'];
		$this->db->set( array(
			'active'=>0
			));
		$this->db->where('id', $placeId);
		$this->db->update('cities');
		Redirect('CitiesController/create');
	}
	public function activcity()
	{
	$placeId = $this->input->post('post_id');
	$data=array('active'=>1);	
	$this->City->update($data,$placeId);
	Redirect('PumpsController/create');
	}
}
?>
