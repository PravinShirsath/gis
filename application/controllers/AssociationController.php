<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AssociationController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database(); 
		$this->load->model('Association'); 
		$this->load->model('Login_model');
		$this->load->model('SendSMS');
	}	
	public function create()
	{
		$associations['associations']= $this->Association->fetch_record('associations');
		$data=array('associations'=>$associations);
	    $this->load->view('Associations/create',$data);
	}	
	public function activelist()
	{
		$associations['associations']= $this->Association->fetch_record('associations');
		$data=array('associations'=>$associations);
		$this->load->view('Associations/activelist',$data);
	}	
	public function deactivatelist()
	{
		$associations['associations']= $this->Association->fetch_deactiverecord('associations');
		$data=array('associations'=>$associations);
		$this->load->view('Associations/deactivatelist',$data);
	}	
	public function store()
	{
		if (isset($_POST['save']))
		{	 
			$data = array(
				'association_name'=>$this->input->post('association_name'),
				'route_name'=>$this->input->post('route_name'),
				'person_name'=>$this->input->post('person_name'),
				'person_email'=>$this->input->post('person_email'),
				'person_phone1'=>$this->input->post('person_phone1'),
				'person_phone2'=>$this->input->post('person_phone2'),
				'active'=>'1',
				'created_at'=>date('Y-m-d H:i:s'),
			);
			$result = $this->Association->validateassociation($this->input->post('association_name'),$this->input->post('person_email'),$this->input->post('person_phone1'));		 
				if(! $result)
				{
					$insert = $this->Association->insert($data);
					if($insert)
					{
						$insert_id=$this->db->insert_id(); 
						$data = array(
						'id'=>'',
						'name'=>$this->input->post('association_name'),
						'username'=>$this->input->post('person_email'),
						'mobile'=>$this->input->post('person_phone1'),
						'personName'=>$this->input->post('person_name'),
						'password'=>'welcome',
						'role'=>'Association',			
						'parentId'=>$insert_id,			
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_by'=>'1',
						);
						$insert = $this->Login_model->insert($data);
					//SMS Code	
						$person_name=$this->input->post('person_name');
						$association_name=$this->input->post('association_name');
						$person_email=$this->input->post('person_email');
						$person_phone1=$this->input->post('person_phone1');
						$SMSUser = 'sawasdee12345spa';
						$password = '123456';
						$sid = 'PETROA';
						$to = $this->input->post('person_phone1');
						$message = "Welcome $person_name, You are registered as an Association ADMIN of $association_name.Click Link: ";
						$link="http://petroasso.skytechhub.com/index.php/LoginController?username=".$person_email;  
						$message=$message.$link;        
						$sendSMS = $this->SendSMS->sendSMS($SMSUser, $password, $message, $to, $sid);

						if($this->input->post('person_email'))
						{
							$to = $this->input->post('person_email');							
							$subject = "Pump Association Login Details";
							$emailMessage = "<html>
											<head>
											<title>Website Contact Us</title>
											</head>
											<body>
											<br><br>
											Dear $person_name, <br>
											Greetings from Sky Tech Hub.<br>
											You are registered as ADMIN for Pump Association of $association_name.<br>
											Click Link: <br>
											http://petroasso.skytechhub.com/index.php/LoginController?username=$person_email<br><br>
											
											User Credentials<br>
											URL : http://petroasso.skytechhub.com<br>
											UserId : $person_email<br>
											Default Password(for first login) : welcome<br><br>

											Thanks and Regards.<br><br>

											$association_name<br><br>

											http://www.skytechhub.in/<br>										
											</body>
											</html>";

							// Always set content-type when sending HTML email
							$headers = "MIME-Version: 1.0" . "\r\n";
							$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

							// More headers
							//$headers .= 'From: <'.$emailid.'>' . "\r\n";
							$headers .= 'From: <contact@skytechhub.com>' . "\r\n";
							mail($to,$subject,$emailMessage,$headers);		
						}
						
						echo "<script>alert('Assocation added successfully..!');</script>";
						echo "<META http-equiv='refresh' content='0;URL=create'>";	
					}
				}				
				else
				{			
				  	echo "<script>alert('This EmailId or MobileNo or Assocation NAME already Exists..!');</script>";
					echo "<META http-equiv='refresh' content='0;URL=create'>";	
				}				 
		}
		elseif (isset($_POST['edit']))
		{
			$data=array(
			'association_name'=>$this->input->post('association_name'),
			'route_name'=>$this->input->post('route_name'),
			'person_name'=>$this->input->post('person_name'),
			'person_phone1'=>$this->input->post('person_phone1'),		
			'person_phone2'=>$this->input->post('person_phone2')		
			);
			$id=$_POST['id'];
			$upt=$this->Association->update($data,$id);			
			if(!$upt)
			{
				echo "<script>alert('Some Issues!');</script>";
				echo "<META http-equiv='refresh' content='0;URL=create'>";
			}
			else
			{
				echo "<script>alert('Association Updated Sucessfully!');</script>";
				echo "<META http-equiv='refresh' content='0;URL=create'>";
			}
		}		
	}
	public function edit($id)
	{
		$associations['associations']= $this->Association->fetch_record('associations');
		$singleassociations['singleassociations']= $this->Association->fetch_where($id);
		$data=array('associations'=>$associations,'singleassociations'=>$singleassociations);
		$this->load->view('Associations/create',$data);
	}
	public function discard()
	{
		$placeId = $_POST['post_id'];
		$data=array('active'=>0);		
		$this->Association->update($data,$placeId);
		Redirect('AssociationController/create');
	}	
	public function activateassocation()
	{
	$placeId = $_POST['post_id'];
	$data = array('active'=>1);	 
	$this->Association->update($data,$placeId);
	Redirect('AssociationController/create');
	}
}
?>