<?php 
	class City extends CI_Model {

	function __construct() { 
	parent::__construct(); 
	} 

	public function insert($data) { 
	
	 $query=$this->db->insert("cities", $data);	 
	return true; 
	} 
	public function fetch_record($table)
	{
	 $this->db->where(array('active'=>1));
	 $query=$this->db->get($table);
	return $query->result();
	} 
	 public function fetch_where($id)
	  {
		   $query=$this->db->get_where('cities',array('id'=>$id));
	   return $query;
		  
	  }
		 public function fetch_where_cities($regionsid)
	  {
		   $query=$this->db->get_where('cities',array('regionId'=>$regionsid));
	   return $query;
		  
	  }
	  public function update($data,$id) { 
	$this->db->set($data);
	$this->db->where('id',$id);
	 if ($this->db->update("cities")) { 
		return true; 
	 } 
	}
	} 
?> 