<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Defaulter extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}    
	public function fetch_record($table)
	{
		$uid=$this->session->userdata('userid');
		$this->db->where(array('active'=>1));	   
		$this->db->where(array('updatet_by'=>$uid));
		$query=$this->db->get($table);
		return $query->result();
	}
	public function fetch_allrecord($table)
	{
		$this->db->where(array('active'=>1));	   
		$query=$this->db->get($table);
		return $query->result();
	} 
	public function fetch_where($id)
	{
		$query=$this->db->get_where('blocktransporter',array('id'=>$id));
		return $query->result();
	}
	
	public function fetchWhereUser($mobileNo)
	{
		$query=$this->db->get_where('pumps',array('mobileNo'=>$mobileNo));
		return $query->result();
	}	
	
	public function fetchWhereList($id)
	{
		$query=$this->db->get_where('blocktransporter',array('updatet_by'=>$id));
		return $query->result();
	}
	public function insert($data)
	{ 
        $query=$this->db->insert("blocktransporter", $data);	 
        return true; 
    }
	
	public function insertLog($data)
	{ 
        $query=$this->db->insert("logs", $data);	 
        return true; 
    }
	  
	public function update($data,$id) { 
	$this->db->set($data);
	$this->db->where('id',$id);
	 if ($this->db->update("blocktransporter")) { 
		return true; 
	 } 
	}
}
?>