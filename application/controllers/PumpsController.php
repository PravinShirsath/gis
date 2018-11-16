<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PumpsController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();
		$this->load->model('City');
		$this->load->model('Association');
		$this->load->model('Company');
		$this->load->model('pump');
		$this->load->model('Login_model');
		$this->load->model('SendSMS');
		$this->load->model('Salsezone');
	}	
	public function index()
	{
		$parentId=$this->session->userdata('parentId');
		$this->db->select('regions.name as regionname,cities.name as cityname,associations.association_name,pumps.*,companies.name as companyName');
		$this->db->from('pumps', 'regions','companies','associations','cities');
		$this->db->join('regions', 'pumps.regionId = regions.id');
		$this->db->join('cities', 'pumps.cityId = cities.id');
		$this->db->join('companies', 'pumps.companyId = companies.id');
		$this->db->join('associations', 'pumps.associationid = associations.id');
		$this->db->where(array('pumps.associationid'=>$parentId,'pumps.active'=>1));		
		$result = $this->db->get(); 
		$pumps=$result->result();	
        $data=array('pumps'=>$pumps);
		$this->load->view('Pumps/list',$data);
	}

	public function listtoall()
	{
		$parentId=$this->session->userdata('parentId');
		$this->db->select('regions.name as regionname,cities.name as cityname,associations.association_name,pumps.*,companies.name as companyName');
		$this->db->from('pumps', 'regions','companies','associations','cities');
		$this->db->join('regions', 'pumps.regionId = regions.id');
		$this->db->join('cities', 'pumps.cityId = cities.id');
		$this->db->join('companies', 'pumps.companyId = companies.id');
		$this->db->join('associations', 'pumps.associationid = associations.id');
		$this->db->where(array('pumps.associationid'=>$parentId,'pumps.active'=>1));		
		$result = $this->db->get(); 
		$pumps=$result->result();	
		$data=array('pumps'=>$pumps);
		$this->load->view('Pumps/listtoall',$data);
	}
	public function deactivatelist()
	{
		$parentId=$this->session->userdata('parentId');
		$this->db->select('regions.name as regionname,cities.name as cityname,associations.association_name,pumps.*,companies.name as companyName');
		$this->db->from('pumps', 'regions','companies','associations','cities');
		$this->db->join('regions', 'pumps.regionId = regions.id');
		$this->db->join('cities', 'pumps.cityId = cities.id');
		$this->db->join('companies', 'pumps.companyId = companies.id');
		$this->db->join('associations', 'pumps.associationid = associations.id');
		$this->db->where(array('pumps.associationid'=>$parentId,'pumps.active'=>0));		
		$result = $this->db->get();
		$pumps=$result->result();	
        $data=array('pumps'=>$pumps);
		$this->load->view('Pumps/deactivatelist',$data);		
	}	
	public function activationpendinglist()
	{
		$parentId=$this->session->userdata('parentId');		 
		$pumps['pumps']=$this->Login_model->fetch_where($parentId);	
		$data=array('pumps'=>$pumps);
		$this->load->view('Pumps/activationpendinglist',$data);
	}	
	
	public function create()
	{
		$regions['regions']= $this->City->fetch_record('regions');//print_r($regions);
		$associations['associations']= $this->Association->fetch_record('associations');
		$company['company']= $this->Company->fetch_record('companies'); 
		//zone Dropdown
		$zone['zone']= $this->Salsezone->fetch_record('salsezone');		
		$role=$this->session->userdata('role');
		$data=array('regions'=>$regions,'associations'=>$associations,'company'=>$company,'zone'=>$zone);	
		if($role=='Pumps')
		{
			$id=$this->session->userdata('parentId');
			$email=$this->session->userdata('username');
			$singlepumps['singlepumps']= $this->pump->fetch_where_pump($id,$email);
			$data=array('regions'=>$regions,'associations'=>$associations,'company'=>$company,'singlepumps'=>$singlepumps);	
		}
		$this->load->view('Pumps/create',$data);
	}	
	public function createnew()
	{
		$regions['regions']= $this->City->fetch_record('regions');//print_r($regions);
		$associations['associations']= $this->Association->fetch_record('associations');
		$company['company']= $this->Company->fetch_record('companies');
		$zone['zone']= $this->Salsezone->fetch_record('salsezone');
        $data=array('regions'=>$regions,'associations'=>$associations,'company'=>$company,'zone'=>$zone);	
		$this->load->view('Pumps/createnew',$data);
	}
	public function UpdatePumpProfile()
	{	
		$associationId=$this->input->post('associationId');
		$associations['associations']= $this->Association->fetch_where($associationId);
		foreach($associations['associations']->result() as $association)
		{
			$associationName=$association->association_name;   
		}
		$parentId=$this->session->userdata('parentId');			
		if(!empty($this->input->post('oldCCode'))){
		$data=array(			 
		//'ccode'=>$this->input->post('oldCCode'),
		'name'=>$this->input->post('pumpname'),
		'ownerName'=>$this->input->post('Ownername'),
		'address'=>$this->input->post('Address'),		
		'companyId'=>$this->input->post('Company'),							
		'regionId'=>$this->input->post('regions'),				
		'cityId'=>$this->input->post('cityId'),						
		'PINCode'=>$this->input->post('pincode'),						
		'mobileNo'=>$this->input->post('Mobile'),						
		'mobile1'=>$this->input->post('Mobile1'),						
		'mobile2'=>$this->input->post('Mobile2'),			 
		'password'=>'Welcome',				
		'email'=>$this->input->post('eMailId'),						
		'active'=>1,						
		'created_at'=>date('Y-m-d H:i:s'),	
		'updated_at'=>date('Y-m-d H:i:s')			 	
		);
			//$checkpump = $this->pump->checkccode($this->input->post("oldCCode"));	
		}
		else{
		$data=array(	
		'name'=>$this->input->post('pumpname'),
		'ownerName'=>$this->input->post('Ownername'),
		'address'=>$this->input->post('Address'),		
		'companyId'=>$this->input->post('Company'),							
		'regionId'=>$this->input->post('regions'),				
		'cityId'=>$this->input->post('cityId'),						
		'PINCode'=>$this->input->post('pincode'),						
		'mobileNo'=>$this->input->post('Mobile'),						
		'mobile1'=>$this->input->post('Mobile1'),						
		'mobile2'=>$this->input->post('Mobile2'),			 
		'password'=>'Welcome',				
		'email'=>$this->input->post('eMailId'),						
		'active'=>1,						
		'created_at'=>date('Y-m-d H:i:s'),	
		'updated_at'=>date('Y-m-d H:i:s')			 	
		);
		//$checkpump = $this->pump->checkccode($this->input->post("ccode"));		 
		}			
		
			$id=$this->input->post('id');
			$base_url=base_url();			  
			$updt=$this->pump->update($data,$id);										
			if($updt){
					$emailId=$this->input->post('eMailId');				 
				$this->Login_model->updateparentId($emailId);
				$this->pump->SendSMSonPumpActivation($associationName, $this->input->post('pumpname'),
				$this->input->post('Ownername'),$this->input->post('Company'),
				$this->input->post('Mobile'),$this->input->post('cityId'),$parentId);					
				echo "<script>alert('Profile Updated successfully..!');</script>";
				echo "<META http-equiv='refresh' content='0;URL=$base_url/index.php/welcome'>";
			}			  
		
	}
	public function StoreforAL()
	{		 
			if(isset($_POST['save']))
			{
			$uid=$this->session->userdata('userid');
			$parentId=$this->session->userdata('parentId');
			$uname=$this->session->userdata('name');
			$result = $this->pump->validate($this->input->post('eMailId'),$this->input->post('Mobile'));//print_r($result);die;       
				if(! $result){
					$data=array(
					'id'=>'',			 
					'ownerName'=>$this->input->post('Ownername'),
					'name'=>$this->input->post('pumpname'),					
					'mobileNo'=>$this->input->post('Mobile'),
					'associationid'=>$parentId,	
					'email'=>$this->input->post('eMailId'),	
					'zonename'=>$this->input->post('zonename'),					
					'active'=>1,						
					'created_at'=>date('Y-m-d H:i:s'),	
					'updated_at'=>date('Y-m-d H:i:s'),				 
					'updated_by'=>$uid	
					);
					//print_r($data);die;
					$insert=$this->pump->insert($data);										
					if($insert)
					{
						$insert_id=$this->db->insert_id();
						$data = array(
						'id'=>'',
						'name'=>$this->input->post('Ownername'),
						'username'=>$this->input->post('eMailId'),
						'password'=>'welcome',
						'mobile'=>$this->input->post('Mobile'),
						'personName'=>$this->input->post('pumpname'),
						'zonename'=>$this->input->post('zonename'),
						'role'=>'Pumps',			
						'parentId'=>$parentId,		
						'profileUpdate'=>0,	
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_by'=>$uid,
						);
						if($this->Login_model->insert($data)){					
							$person_name=$this->input->post('Ownername');			  
							$person_email=$this->input->post('eMailId');
							$person_phone=$this->input->post('Mobile');			 
							$SMSUser = 'sawasdee12345spa';
							$password = '123456';
							$sid = 'PETROA';
							$to = $this->input->post('Mobile');
							$message = "Welcome $person_name, Your Agency registered in Association $uname. Click to ACTIVATE your Account:";
							$link="http://petroasso.skytechhub.com/index.php/LoginController?username=".$person_email;  
							$message=$message.$link;
							//$sendSMS = $this->SendSMS->sendSMS($SMSUser, $password, $message, $to, $sid);				
							 if($person_email)
							{
																 
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
													You are registered as Agency Owner in $qurow->association_name Agency Owners Association.<br>
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


								//	 mail($to,$subject,$emailMessage,$headers);	

										
									}

								echo "<script>alert('Agency successfully Saved..!');</script>";
							   echo "<META http-equiv='refresh' content='0;URL=create'>";
								  }
				   }
				}
				}
				else{
					echo "<script>alert('This EmailId  or Mobile No. Already Exists!');</script>";
					echo "<META http-equiv='refresh' content='0;URL=create'>";
				}
				}
				elseif(isset($_POST['edit']))
				{
					$data=array(						 
					'name'=>$this->input->post('Ownername'),								
					'mobile'=>$this->input->post('Mobile'),
					'username'=>$this->input->post('eMailId'),				
					);	
					$id=$this->input->post('userid');		
  					$update=$this->pump->updatepump($data,$id);
					if(!$update)
					{
						echo "<script>alert('Unable to Update');</script>";
						echo "<META http-equiv='refresh' content='0;URL=create'>";
					}
					else
					{
						echo "<script>alert('Updated Successfully');</script>";
					echo "<META http-equiv='refresh' content='0;URL=create'>";
					}
				}
	}
	public function getcities()
	{
		$regionsid=$_GET['regionid'];
		$query=$this->City->fetch_where_cities($regionsid);
		echo "<option value=''>Select</option>";
		foreach($query->result() as $row)
		{
			echo "<option value='$row->id'>$row->name</option>";
		}
	}	
	public function discard()
	{
		$placeId = $this->input->post('post_id');
		$data=array('active'=>0);
		$this->pump->update($data,$placeId);
		Redirect('PumpsController/create');
	}
	public function deleterecord()
	{
			$placeId = $_POST['post_id']; 
			$deletependingpump=$this->pump->deletependingpump($placeId);
	}
	public function activatepump()
	{
	$placeId = $this->input->post('post_id');
	$data=array('active'=>1);	
	$this->pump->update($data,$placeId);
	Redirect('PumpsController/create');
	}
	public function sendSMStoPump()
	{
		$mobileno = $this->input->post('mobileno');		
		$singlepumps['singlepumps']= $this->pump->sendParticularSMS($mobileno);
		$person_name=$singlepumps['singlepumps']->name;
		$person_email=$singlepumps['singlepumps']->username;
		$mobileNo=$singlepumps['singlepumps']->mobile;
		$uname=$this->session->userdata('name');		 
		$SMSUser = 'sawasdee12345spa';
		$password = '123456';
		$sid = 'PETROA';
		$to = $mobileNo;
		$message = "Reminder, Dear $person_name, Click to ACTIVATE your Agency Account which is registered in Association; $uname. :";
		$link="http://petroasso.skytechhub.com/index.php/LoginController?username=".$person_email;  
		$message=$message.$link;
		$sendSMS = $this->SendSMS->sendSMS($SMSUser, $password, $message, $to, $sid);			
	}
	
	public function edit()
	{
		$regions['regions']= $this->City->fetch_record('regions');//print_r($regions);
		$associations['associations']= $this->Association->fetch_record('associations');
		$company['company']= $this->Company->fetch_record('companies'); 
		$zone['zone']= $this->Salsezone->fetch_record('salsezone');	
		$id=$this->session->userdata('parentId');
		$email=$this->session->userdata('username');
		$singlepumps['singlepumps']= $this->pump->fetch_where_pump($id,$email);
        $data=array('regions'=>$regions,'associations'=>$associations,'company'=>$company,'singlepumps'=>$singlepumps);	
		$this->load->view('Pumps/edit',$data);
	}
	public function edit1()
	{
		$this->load->view('Pumps/edit1');
	}
}
