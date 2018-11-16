<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class pump extends CI_Model
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
  public function fetch_where($id)
  {
	   $query=$this->db->get_where('pumps',array('id'=>$id));
   return $query;	  
  }
	public function checkccode($ccode)
	{
		 $this->db->select('ccode');
         $this->db->from('pumps'); 
         $this->db->where('ccode', $ccode); 
         $query=$this->db->get();
         return $query->row_array();
	}

	public function checkUpdateDuplicate($mobileNo, $dataMobileNo, $id, $associationid)
	{
		$this->db->where(array('id !='=>$id));
		$this->db->where(array('associationid !='=>$associationid));
		$this->db->where(array($dataMobileNo=>$mobileNo));
		$query=$this->db->get('pumps');
	    return $query->result();
	}
    
	
	public function deletependingpump($placeId)
	{
		 $this->db->select('username,mobile');
         $this->db->from('users'); 
         $this->db->where('id', $placeId); 
         $query=$this->db->get();
        if($data=$query->row())
		{ 	
			$email=$data->username;
			$mobile=$data->mobile;
			 $this->db->where('mobileNo', $mobile); 
			 $this->db->where('email', $email); 
			 $this->db->delete('pumps');
			 $this->db->where('id', $placeId);
			 $this->db->delete('users');
			return true; 
		}
		else
		{
			return false; 
		}	    
	}
	
	
	public function update($data,$id) { 
		$this->db->set($data);
		$this->db->where('id',$id);
		$this->db->update("pumps"); 
		return true; 	 
	}
	public function insert($data) { 
	 if ($this->db->insert("pumps", $data)) { 
		return true; 
	 } 
	}
	 public function fetch_where_pump($id,$email)
  {
	   $query=$this->db->get_where('pumps',array('associationid'=>$id,'email'=>$email));
		return $query->result();	  
  }
	public function sendParticularSMS($mobileno)
  {
	   $query=$this->db->get_where('users',array('mobile'=>$mobileno));
       return $query->row();	  
  }
	 public function validate($email,$mobileNo)
	{
        $this->db->select('username,mobile');
        $this->db->from('users'); 
        $this->db->where('username', $email); 
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
	
	public function SendSMSonPumpActivation($associationName,$pumpname,$Ownername,$Company,$Mobile,$cityid,$parentId)
	{
		//$uname=$this->session->userdata('name');
		$city=$this->db->query("select name from cities where id=$cityid")->row()->name;
		$Company1=$this->db->query("select name from companies where id=$Company")->row()->name;
		$SMSUser = 'sawasdee12345spa';
		$password = '123456';
		$sid = 'PETROA';	
		$message = "Dear Sir/Madam, \n1 Agency ADDED in $associationName Association.\nWelcome owner $Ownername, $Mobile of '$pumpname' of '$Company1' Agency in $city.";
		$this->db->select('mobileNo');
		$this->db->where('associationid',$parentId);
		$query=$this->db->get('pumps');
		
		foreach($query->result() as $row)
		{
			$to = $row->mobileNo; 
                         $sendSMS = $this->SendSMS->sendSMS($SMSUser, $password, $message, $to, $sid);	
		}		
	}
	
	public function SendSMSonAddDefaulter($transportersName,$amount,$transportersCompany,$city,$mobile,$parentId)
	{
		$city1=$this->db->query("select name from cities where id=$city")->row()->name;
		$SMSUser = 'sawasdee12345spa';
		$password = '123456';
		$sid = 'PETROA';	
		$message = "Dear Agency Owners, \n1 DEFAULTER Added. Name $transportersName, Rs. $amount, $transportersCompany, $city1, $mobile";
		$this->db->select('mobileNo');
		$this->db->where('associationid',$parentId);
		$query=$this->db->get('pumps');
		
		foreach($query->result() as $row)
		{
			 $to = $row->mobileNo; 
		     $sendSMS = $this->SendSMS->sendSMS($SMSUser, $password, $message, $to, $sid);	
		}		
		
	}
		public function SendSMSonUpdateDefaulter($transportersName,$amount,$transportersCompany,$city,$mobile,$parentId)
	{
		$city1=$this->db->query("select name from cities where id=$city")->row()->name;
		$SMSUser = 'sawasdee12345spa';
		$password = '123456';
		$sid = 'PETROA';	
		$message = "Dear Agency Owners, \n1 DEFAULTER Updated. Name $transportersName, Rs. $amount, $transportersCompany, $city1, $mobile";
		$this->db->select('mobileNo');
		$this->db->where('associationid',$parentId);
		$query=$this->db->get('pumps');
		
		foreach($query->result() as $row)
		{
			 $to = $row->mobileNo; 
		     $sendSMS = $this->SendSMS->sendSMS($SMSUser, $password, $message, $to, $sid);	
		}		
		
	}
	public function updatepump($data,$id)
	{
		$this->db->set($data);
		$this->db->where('id',$id);
	   if ($this->db->update("users")) { 
	   $data= array(						 
			'ownerName'=>$this->input->post('Ownername'),								
			'mobileNo'=>$this->input->post('Mobile'),
			'email'=>$this->input->post('eMailId'),				
			);		
			$this->db->set($data);
			$this->db->where('email',$this->input->post('useremail'));
			$this->db->where('mobileNo',$this->input->post('usermobileNo'));
			if($this->db->update("pumps"))
			{						
					$person_name=$this->input->post('Ownername');			  
					$person_email=$this->input->post('eMailId');
					$person_phone=$this->input->post('Mobile');			 
					$SMSUser = 'sawasdee12345spa';
					$password = '123456';
					$sid = 'PETROA';
					$to = $this->input->post('Mobile');
					$message = "Dear $person_name, Your Agency Details Updated Successfully. Click to ACTIVATE your Account:";
					$link="http://petroasso.skytechhub.com/index.php/LoginController?username=".$person_email;  
					$message=$message.$link;
					$sendSMS = $this->SendSMS->sendSMS($SMSUser, $password, $message, $to, $sid);				
					 if($person_email)
					{
							 $uid=$this->session->userdata('userid');							 
							 $this->db->select('parentId');	
							 $this->db->where(array('id'=>$uid));	 
							 $qu=$this->db->get('users');
							 $query=$qu->row();
							 $assocId=$query->parentId;
									 if($assocId)
									 {
										$uid=$this->session->userdata('userid');
										 $this->db->select('*');	
										 $this->db->where(array('id'=>$assocId));	 
										 $qu=$this->db->get('associations');
											 $qurow=$qu->row();                               

										 $to = $this->input->post('eMailId');
										//$to = 'nikhilkholam@gmail.com';
										$subject = "Agency Owner Login Details";						

										$emailMessage = "<html>
													<head>
													<title>Website Contact Us</title>
													</head>
													<body>
													<br><br>

													Dear $person_name, <br>
													Greetings from $qurow->association_name.<br>
													Your Agency  Details are updated in $qurow->association_name Agency Owners Association.<br>
													Click Link: <br>
													http://petroasso.skytechhub.com/index.php/LoginController?username=$person_email<br><br>
													
													<b>User Credentials<b><br>
													URL 	: http://petroasso.skytechhub.com<br>
													UserId  : $person_email<br>
													Default Password(for first login) : welcome<br><br>

													Please Login now and Acivate your Agency in this Association.<br><br>

													Thanks and Regards.<br><br>

													$qurow->association_name<br>
													$qurow->route_name<br>
													$qurow->person_name<br>
													$qurow->person_phone1<br><br>

													http://www.skytechhub.in/<br>										
													</body>
													</html>";

																 $eid=$qurow->person_email;
																 $headers = "MIME-Version: 1.0" . "\r\n";
									$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

									// More headers
									$headers .= 'From: <'.$eid.'>' . "\r\n";
									//$headers .= 'From: <contact@skytechhub.com>' . "\r\n";


									 mail($to,$subject,$emailMessage,$headers);	

										
									}
								  }
			}				
			
				
		return true; 
	 } 
	}
}
?>