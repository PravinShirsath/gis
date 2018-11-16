<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Salsezone extends CI_Model
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
    public function insert($data) { 
         if ($this->db->insert("salsezone", $data)) { 
            return true; 
         } 
      } 
	   public function fetch_where($id)
	  {
		   $query=$this->db->get_where('salsezone',array('id'=>$id));
	   return $query;
		  
	  }
	   public function fetch_deactiverecord($table)
		{
	   $this->db->where(array('active'=>0));
	   $query=$this->db->get($table);
	   return $query->result();
		}
}
?>