<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }    
    public function validate(){
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        $this->db->where('username', $username);
        $this->db->where('password', $password);        
        $query = $this->db->get('users');//echo $this->db->last_query();
     //   print_r($query);die;
		if(count($query->result()) == 1)
        {
			$row = $query->row();
            $data = array(
                    'profileUpdate' => $row->profileUpdate,
                    'userid' => $row->id,
                    'name' => $row->name,
                    'username' => $row->username,
                    'parentId' => $row->parentId,
                    'personName' => $row->personName,
                    'loginpass' => $row->password,
                    'role' => $row->role,
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
		else
		{
        return false;
		}
    }
	public function ForgotPassword($mobile)
	{
        $this->db->select('mobile');
        $this->db->from('users'); 
        $this->db->where('mobile', $mobile); 
        $query=$this->db->get();
       if($query->row_array())
	   {   
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$password1= substr(str_shuffle($chars),0,5);			
		$SMSUser = 'sawasdee12345spa';
		$password = '123456';
		$sid = 'PETROA';
		$to = $mobile; 
		$message = "Your New Password is $password1";					
		$sendSMS = $this->SendSMS->sendSMS($SMSUser, $password, $message, $to, $sid);	  
		 $this->db->set(array('password'=>$password1));
		 $this->db->where(array('mobile'=> $mobile));
		 if($this->db->update('users'))
		{	
		   return true; 
		}
	   }
	}
	public function changepassword($password)
	{
        $username = $this->session->userdata('username');	
		$this->db->set(array('password'=>$password));
		$this->db->where(array('username'=> $username));
		if($this->db->update('users'))
		{	
		   return true;
		}
		else
		{
			return false;
		}
	}
	public function insert($data) { 
	 if ($this->db->insert("users", $data)) { 
		return true; 
	 } 
	}
	public function updateparentId($emailId) { 
	$parentId=$this->session->userdata('parentId');
	$this->db->set(array('profileUpdate'=>1));
	$this->db->where('parentId',$parentId);
	$this->db->where('username',$emailId);
	 if ($this->db->update("users")) { 
		$this->session->set_userdata('profileUpdate', 1);
		return true; 
	 } 
	}
	public function fetch_where($id)
	{
		$this->db->where(array('parentId'=>$id));
		$this->db->where(array('profileUpdate'=>0));
		$this->db->where(array('role'=>'Pumps'));
		$query=$this->db->get('users');
	    return $query->result();
	}
	public function fetch_pumpuser($id)
	{
		$this->db->where(array('id'=>$id));
		$query=$this->db->get('users');
	    return $query->result();
	}
}
?>