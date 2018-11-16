<?php 
   class Region extends CI_Model {	
      function __construct() { 
         parent::__construct(); 
      }   
	public function fetch_Record($table) { 
        $this->db->where(array('active'=>1));
		$query=$this->db->get($table);	
		return $query->result();         
		}
	public function insert($data) { 
        $query=$this->db->insert("regions", $data);	 
        return true; 
      } 
     public function fetch_where($id)
	  {
		   $query=$this->db->get_where('regions',array('id'=>$id));
	   return $query;
		  
	  }
  public function checkregion($name)
	{
        $this->db->select('name');
        $this->db->from('regions'); 
        $this->db->where('name', $name); 
        $query=$this->db->get();
        return $query->row_array();
	}
	   public function fetch_deactiverecord($table)
		{
	   $this->db->where(array('active'=>0));
	   $query=$this->db->get($table);
	   return $query->result();
		}
		  public function update($data,$id) { 
	$this->db->set($data);
	$this->db->where('id',$id);
	 if ($this->db->update("regions")) { 
		return true; 
	 } 
	}
   } 
?> 