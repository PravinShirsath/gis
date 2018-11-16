<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LoginController extends CI_Controller{    
    function __construct(){
        parent::__construct();
		$this->load->model('Login_model');
		$this->load->model('SendSMS');
    }
   public function index($msg = NULL){
        $data['msg'] = $msg;
        $this->load->view('loginpage', $data);
    }    
    public function process(){
        // Load the model
        
        // Validate the user can login
        $result = $this->Login_model->validate();//print_r($result);die;
        // Now we verify the result
        if(! $result){
            $msg = '<font color=red>Invalid username and/or password.</font><br />';
            $this->index($msg);
        }else{
			if($this->session->userdata('loginpass') == 'welcome')
			{
				redirect('LoginController/changepassword');
			}
            elseif($this->session->userdata('role') == 'Pumps' && $this->session->userdata('profileUpdate') == '0')
			{
				redirect('PumpsController/create');
			}
			else{redirect('Welcome');}
        }        
    }
	 public function do_logout(){
        $this->session->sess_destroy();
		$sess_data = array('role'=>'','profileUpdate'=>'','uname' => '', 'username' => '', 'userphone' => '', 'uid' => '', 'upass' => '');
		$this->session->set_userdata($sess_data);
        echo "<script>alert('Succesfully Logout..!');</script>";
	    echo "<META http-equiv='refresh' content='0;URL=index'>";
    }
	
	public function changepassword()
	{		
		$this->load->view('changepassword');
	}
	public function changepass()
    {
		if(isset($_POST['changepass']))
		{		 
			 $password = $this->input->post('newpassword');  
			 $changepassword = $this->Login_model->changepassword($password);  
			  if(! $changepassword){
				  redirect('Welcome/changepw');	
			  }
			  else{
					$role = $this->session->userdata('role');	
					$profileUpdate=$this->session->userdata('profileUpdate');
					if($role == 'Pumps' && $profileUpdate ==0 )
					{ 
						$url=base_url().'/index.php/PumpsController/create';
					}
					else 
					{
						$url='do_logout';
					}
					echo "<script>alert('Password Changed Successfully..!');</script>";
					echo "<META http-equiv='refresh' content='0;URL=$url'>";	
			  }
		}			
    }
	public function forgetpw()
	{
			$mobile = $this->input->post('mobile');      
            $findmobile = $this->Login_model->ForgotPassword($mobile);  
            if($findmobile){
			  $msg = '<font color=red>Your NEW Password sent by SMS on your registered Mobile.</font><br />';            
	        	$this->index($msg);		 
            }else{
		     $msg = '<font color=red>Mobile Number not found!</font><br />';            
		     $this->index($msg);           
		   }		
	}
}
?>