<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BlockTransporterController extends CI_Controller {
public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','html'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->database();		 
		$this->load->model('Region');		
		$this->load->model('Defaulter');
		$this->load->model('pump');	
		$this->load->model('SendSMS');	
	}
	public function index()
	{
		$defaulter['defaulter']= $this->Defaulter->fetch_allrecord('blocktransporter');		 
		$this->load->view('BlockTransporters/alldefaulters',$defaulter);
	}		
	public function create()
	{
		$regions['regions']= $this->Region->fetch_record('regions');
		$defaulter['defaulter']= $this->Defaulter->fetch_record('blocktransporter');
		$data=array(
					'regions'=>$regions,
					'defaulter'=>$defaulter
					);
		$this->load->view('BlockTransporters/create',$data);
	}
	public function store()
	{
		if (isset($_POST['Save']))
		{
			$file_name;
			if (!empty($_FILES['image']['name'])) 
                {       
                    if(isset($_FILES['image']['name']))
                    {
                    $file_name=preg_replace('/[^A-Za-z0-9\-]/', '','').$_FILES['image']['name'];
					//print_r($file_name);die;
                    }
                    else
                    {
                    $file_name='';
                    }
                        // $file_name;

                    $temp_name=$_FILES['image']['tmp_name'];  

                    $target_path ="uploads/".$file_name;
                
                    if(move_uploaded_file($temp_name, $target_path)) 
                    {
                    }
                }
				
				$file_name1;
			if (!empty($_FILES['image1']['name'])) 
                {       
                    if(isset($_FILES['image1']['name']))
                    {
                    $file_name1=preg_replace('/[^A-Za-z0-9\-]/', '','').$_FILES['image1']['name'];
					//print_r($file_name);die;
                    }
                    else
                    {
                    $file_name1='';
                    }
                        // $file_name;

                    $temp_name1=$_FILES['image1']['tmp_name'];  

                    $target_path ="uploads/".$file_name1;
                
                    if(move_uploaded_file($temp_name1, $target_path)) 
                    {
                    }
                }
			$uid=$this->session->userdata('userid');
			$parentId=$this->session->userdata('parentId');
			
				
			$data=array(
			'id'=>'',
			 'person_name'=>$_POST['person_name'],
			 'personename2'=>$_POST['textbox2'],
			 'personename3'=>$_POST['textbox3'],
			 'personename4'=>$_POST['textbox4'],
			 'personename5'=>$_POST['textbox5'], 
			'company_name'=>$_POST['company_name'],
			'aadharno'=>$_POST['aadharno'],
			'panno'=>$_POST['panno'],
			'region'=>$_POST['regions'],		
			'city'=>$_POST['city'],	
			'email'=>$_POST['email'],				
			'address'=>$_POST['address'],						
			'mobile1'=>$_POST['mobile1'],						
			'mobile2'=>$_POST['mobile2'],						
			'mobile3'=>$_POST['mobile3'],						
			'mobile4'=>$_POST['mobile4'],
			'pending_amount'=>$_POST['number'],
			'default_date'=>$_POST['defaultdate'],
			'remarks'=>$_POST['remarks'],
			'gallery_image'=>$file_name,
			'gallery_image1'=>$file_name1,
			'active'=>1,		
			'created_at'=>date('Y-m-d H:i:s'),
			'updatet_by'=>$uid				
			);
			$insert=$this->Defaulter->insert($data);
			if($insert)
			{
				$transportersName=$_POST['person_name'];
				$amount=$_POST['number'];
				$transportersCompany=$_POST['company_name'];
				$city=$_POST['city'];
				$mobile=$_POST['mobile1'];
				//$this->pump->SendSMSonAddDefaulter($transportersName,$amount,$transportersCompany,$city,$mobile,$parentId);
				}
					echo"Inserted Record";
				/* echo "<script>alert('Defaulter Transporter Added Successfully ..!');</script>";
				echo "<META http-equiv='refresh' content='0;URL=create'>"; */
			}		
		elseif (isset($_POST['Edit']))
		{
			$data=array(
			'person_name'=>$_POST['person_name'],
			'company_name'=>$_POST['company_name'], 
			'aadharno'=>$_POST['aadharno'],
			'panno'=>$_POST['panno'],
			'region'=>$_POST['regions'],		
			'city'=>$_POST['city'],	
			'email'=>$_POST['email'],				
			'address'=>$_POST['address'],						
			'mobile1'=>$_POST['mobile1'],						
			'mobile2'=>$_POST['mobile2'],						
			'mobile3'=>$_POST['mobile3'],						
			'mobile4'=>$_POST['mobile4'],
			'pending_amount'=>$_POST['number'],
			'default_date'=>$_POST['defaultdate'],
			'remarks'=>$_POST['remarks']			
			);
			$id=$_POST['id'];			 
			$updt=$this->Defaulter->update($data,$id);
			if($updt){
				$transportersName=$_POST['person_name'];
				$amount=$_POST['number'];
				$transportersCompany=$_POST['company_name'];
				$city=$_POST['city'];
				$mobile=$_POST['mobile1'];
				//$this->pump->SendSMSonUpdateDefaulter($transportersName,$amount,$transportersCompany,$city,$mobile,$parentId);
				echo "<script>alert('Update Defaulter Transporters successfully ..!');</script>";
				echo "<META http-equiv='refresh' content='0;URL=create'>";
			}
		}
	}
	public function edit($id)
	{
		$regions['regions']= $this->Region->fetch_record('regions');
		$defaulter['defaulter']= $this->Defaulter->fetch_record('blocktransporter');
		$singledefaulters['singledefaulters']= $this->Defaulter->fetch_where($id);
		$data=array(
					'regions'=>$regions,
					'defaulter'=>$defaulter,
					'singledefaulters'=>$singledefaulters
					);
		$this->load->view('BlockTransporters/create',$data);
	}
	
	public function checkRequest()
	{
		$mobileNo=$_POST['mobileNo'];
		$defaulterId = $_POST['defaulterId'];
		$password = $_POST['password'];
		$passwordNew = $_POST['passwordNew'];
		if($passwordNew==$password)
		{
			$defaulter['defaulter']= $this->Defaulter->fetch_where($defaulterId);
			$loger['loger']= $this->Defaulter->fetchWhereUser($mobileNo);	

			$uid=$this->session->userdata('userid');
			$data=array(
			'blockTransporterId'=>$defaulterId,
			'date'=>date('Y-m-d H:i:s'),
			'updatedBy'=>$uid				
			);
			$insert=$this->Defaulter->insertLog($data);	
			if($insert){
			
			$data=array('defaulterId'=>$defaulterId,'loger'=>$loger);
			$this->load->view('BlockTransporters/RequestAllDetails', $data);
			}
		}	
		else
		{
			echo "<script>alert('Please Enter Valid Password');</script>";
			echo "<META http-equiv='refresh' content='0;URL=index'>";
		}
	
	}	
	public function showRequestDetails()
	{
		$this->load->view('BlockTransporterController/RequestAllDetails');
	}

	public function discard()
	{
		$placeId = $_POST['post_id'];
		$this->db->where('id', $placeId);
		$this->db->delete('blocktransporter');
		//Redirect('BlockTransporterController/create');
	}
	public function showPumpSummary()
	{
		$companies['companies']= $this->Defaulter->fetch_allrecord('companies');	
		$this->load->view('BlockTransporters/PumpSummery',$companies);
	}
	public function myDefaulterList()
	{	
		$id=$this->session->userdata('userid');
		$defaulter['defaulter']= $this->Defaulter->fetchWhereList($id);		 
		$this->load->view('BlockTransporters/MyDefaulterList', $defaulter);
	}
	public function allDefaulterList()
	{
		$defaulter['defaulter']= $this->Defaulter->fetch_allrecord('blocktransporter');		 
		$this->load->view('BlockTransporters/alldefaulters', $defaulter);		
	}
}
?>
