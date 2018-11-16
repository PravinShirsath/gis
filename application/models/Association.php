<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Association extends CI_Model
{
    function __construct(){
        parent::__construct();
    }    
   public function fetch_record($table)
   {
	   $this->db->where(array('active'=>1));
	   $query=$this->db->get($table);
	   return $query->result();
   }   
   public function fetch_deactiverecord($table)
   {
	   $this->db->where(array('active'=>0));
	   $query=$this->db->get($table);
	   return $query->result();
   }
	public function insert($data) { 
	 if ($this->db->insert("associations", $data)) { 
		return true; 
	 } 
	}
	public function fetch_where($id)
	{
	   $query=$this->db->get_where('associations',array('id'=>$id));
	return $query;	  
	}
	public function checknumber($phonenumber)
	{
		 $this->db->select('person_phone1');
         $this->db->from('associations'); 
         $this->db->where('person_phone1', $phonenumber); 
         $query=$this->db->get();
         return $query->row_array();
	}
	public function update($data,$id) { 
	$this->db->set($data);
	$this->db->where('id',$id);
	 if ($this->db->update("associations")) { 
		return true; 
	 } 
	}
	public function validateassociation($name,$email,$mobileNo)
	{
       $this->db->select('name,username,mobile');
        $this->db->from('users'); 
        $this->db->where('name', $name); 
        $this->db->or_where('username', $email); 
        $this->db->or_where('mobile',$mobileNo); 
        $query=$this->db->get();
		if($query->row_array())
		{ 	
			return true; 
		}
		else
		{
			return false; 
		}	    
	}
}
?>