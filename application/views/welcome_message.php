<!-- <head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head> -->
<style>
.small-big{
    width: 100%;
}
.small-big:active{
    width: 95%;
}
.imageAndText {position: relative;} 
.imageAndText .col {position: absolute; z-index: 1; top: 0; left: 0;}
 </style>
<?php 
$uid=$this->session->userdata('userid');
$role=$this->session->userdata('role');
$prf=$this->session->userdata('profileUpdate');
$parentId=$this->session->userdata('parentId');
if(isset($uid))
{ 
include('includes/topbar.php');?>
<?php include('includes/header.php');?>
<?php //include('includes/sidebar.php');?>

<body background="<?php echo base_url();?>dashboardbg.jpg">
<main class="app-content" style="padding-top:90px">

  <?php if($role == 'SuperAdmin')
	{
	?>
	<div class="row" style="margin-top:40px">
	<div class="col-md-6 col-lg-3">
	  <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
		<a href="<?php echo base_url();?>index.php/CompaniesController/create">
		<div class="info">
		  <h4>Add Gas Company</h4>
				<?php $this->db->select('count(*) as cnt');	
				$this->db->where('active',1);
				$qu=$this->db->get('companies');
				$qurow=$qu->row();?>
		  <p><b><?php echo $qurow->cnt;?></b></p>
		</div>
		</a>
	  </div>
	</div>
	
	<div class="col-md-6 col-lg-3">
	  <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
	  <a href="<?php echo base_url();?>index.php/RegionsController/create">
		<div class="info">
		  <h4>Add Region</h4>
		  <?php $this->db->select('count(*) as cnt');
				$this->db->where('active',1);
				$qu=$this->db->get('regions');
				$qurow=$qu->row();?>
		  <p><b><?php echo $qurow->cnt;?></b></p>
		</div>
	  </a>
	  </div>
	</div>
	<div class="col-md-6 col-lg-3">
	  <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
	  <a href="<?php echo base_url();?>index.php/CitiesController/create">
		<div class="info">
		  <h4>Add City</h4>
		  <?php $this->db->select('count(*) as cnt');
				$this->db->where('active',1);		  
				$qu=$this->db->get('cities');
				$qurow=$qu->row();?>
		  <p><b><?php echo $qurow->cnt;?></b></p>
		</div>
	  </a>
	  </div>
	</div>
	<div class="col-md-6 col-lg-3">
	  <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
	   <a href="<?php echo base_url();?>index.php/AssociationController/create">
		<div class="info">
		  <h4>Association</h4>
		<?php $this->db->select('count(*) as cnt');	
				$this->db->where_in('active', '1' );
				$qu=$this->db->get('associations');
				$qurow=$qu->row();?>
		  <p><b><?php echo $qurow->cnt;?></b></p>
		</div>
	</a>
	  </div>
	  <div class="imageAndText">
				<a href="<?php echo base_url();?>index.php/SalsezoneController/create">
					<img class="img-responsive small-big" src="<?php echo base_url();?>assets/img/pumps_btn.png">
				</a>
				<!-- <div class="col">
	      		    <div class="col-sm-12">
	      		    	<h5 style="color: white;float: right;">100</h5>
	   		   		</div>
	    		</div> -->
				</div>
	</div>	
	<div class="col-md-6 col-lg-3">
	  <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
		<div class="info">
		  <h4>Send SMS</h4>
		  <p><b></b></p>
		</div>
	  </div>
	</div>
 
			 
			<div class="col-md-6 col-lg-3">
			<div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
			<div class="info">
			  <a href="<?php echo base_url();?>index.php/BlockTransporterController/showPumpSummary"><h4>Distributors Summary</h4></a>
			  <p><b></b></p>
			</div>
			</div>
			</div>
		 
		
	</div> 
  
  <hr>
	<?php } ?>

  
  	<?php if($role == 'Association')
	{
	?>
	
	<div class="row" style="margin-top:-42px">
	
			<div class="col-md-6 col-lg-3" data-toggle="modal" data-target="#SMSModal">
				<div >
					<a href="#"><img class="img-responsive small-big" src="<?php echo base_url();?>assets/img/sms_btn.png"></a>
				</div>
			</div>
    
	<div class="col-md-6 col-lg-3">
		<!-- <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
			<div class="info">		
				<a href="<?php echo base_url();?>index.php/PumpsController/create">
				<h4>Pumps</h4>
				<?php 
						$this->db->select('count(*) as cnt');				
						$qu=$this->db->get_where('pumps',array('updated_by'=>$uid,'active'=>'1'));
						$qurow=$qu->row();
				?>
		  		<p><b><?php echo $qurow->cnt;?></b></p>
			</div>
			</a>
		</div> -->
		
			<div class="imageAndText">
				<a href="<?php echo base_url();?>index.php/PumpsController/create">
					<img class="img-responsive small-big" src="<?php echo base_url();?>assets/img/pumps_btn.png">
				</a>
				<!-- <div class="col">
	      		    <div class="col-sm-12">
	      		    	<h5 style="color: white;float: right;">100</h5>
	   		   		</div>
	    		</div> -->
			</div>
	</div>

	<div class="col-md-6 col-lg-3">
	  <!-- <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
		<div class="info">
		<a href="<?php echo base_url();?>index.php/BlockTransporterController">		
		  <h4 style="color:red">ALL Defaulters</h4>
		<?php $this->db->select('count(*) as cnt');				
				$qu=$this->db->get('blocktransporter');
				$qurow=$qu->row();?>
		  <p><b><?php echo "Count=".$qurow->cnt;?>, Rs. <?php 
						$this->db->select('SUM(pending_amount) as cnt1');				
						$qu=$this->db->get('blocktransporter');
						$qurow=$qu->row();
						echo number_format(' '.$qurow->cnt1);?>
		  </b></p>
		  </a>
		</div>
		</div> -->
		<div class="">
					<a href="<?php echo base_url();?>index.php/BlockTransporterController">
						<img class="img-responsive small-big" src="<?php echo base_url();?>assets/img/all_defaulters_btn.png""></a>
				</div>
		
	</div> 
 
			 
			<div class="col-md-6 col-lg-3">
				<!-- <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
				<div class="info">
				  <a href="<?php echo base_url();?>index.php/BlockTransporterController/showPumpSummary"><h4>Pump Summary</h4></a>
				  <p><b></b></p>
				</div>
				</div> -->
				<div class="">
					<a href="<?php echo base_url();?>index.php/BlockTransporterController/showPumpSummary">
						<img class="img-responsive small-big" src="<?php echo base_url();?>assets/img/pump_summary_btn.png""></a>
				</div>
			</div>
		 
		
 
		 
	</div>
	<?php } ?>
	<div class="row">
	<?php if($role =='Pumps')
	{
	if($prf == 0){
	?>
	<div class="col-md-6 col-lg-3">
	  <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
			<div class="info">
				<a href="<?php echo base_url();?>index.php/PumpsController/create">	
				<h4 style="color:red">Update Profile</h4>					
				</a>
			</div>
	  </div>
	</div>
	
		<div class="col-md-6 col-lg-3">
			<div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
			<div class="info">
			<a href="<?php echo base_url();?>index.php/PumpsController/listtoall">	
			<h4 style="color:red">All Distributors</h4>					
			</a>
			</div>
			</div>
		</div>
		
	<?php }else { ?>
	<div class="col-md-6 col-lg-3">
	  <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
			<div class="info">
				<a href="<?php echo base_url();?>index.php/BlockTransporterController/create">	
				<h4 style="color:red">MY DEFAULTERS</h4>
					<!--Count--><?php 
						$parentId=$this->session->userdata('parentId');
						$this->db->select('count(*) as cnt');				
						$qu=$this->db->get_where('blocktransporter',array('updatet_by'=>$parentId));
						$qurow=$qu->row();
						//echo ' '.$qurow->cnt;
					?>  
					<!--Rs.--> <?php 
						/* $this->db->select('sum(pending_amount) as amt');				
						$qu=$this->db->get('blocktransporter');
						$qurow=$qu->row();
						echo number_format( ' '.$qurow->amt); */
					?>
				</a>
			</div>
	  </div>
	</div>
	 <div class="col-md-6 col-lg-3">
	  <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
			<div class="info">
				<a href="<?php echo base_url();?>index.php/PumpsController/listtoall">	
				<h4 style="color:red">All Distributors List </h4>
				 
				
				</a>
			</div>
	  </div>
	</div>
	<div class="col-md-6 col-lg-3">
	  <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
		<div class="info">
		<a href="<?php echo base_url();?>index.php/BlockTransporterController">		
		  <h4 style="color:red">ALL Defaulters</h4>
		<?php $this->db->select('count(*) as cnt');				
				$qu=$this->db->get('blocktransporter');
				$qurow=$qu->row();?>
		  <p><b><?php echo "Count=".$qurow->cnt;?>, Rs. <?php 
						$this->db->select('SUM(pending_amount) as cnt1');				
						$qu=$this->db->get('blocktransporter');
						$qurow=$qu->row();
						
						if(isset($qurow->cnt1))
						
						echo number_format(' '.$qurow->cnt1);?>
						
		  </b></p>
		  </a>
		</div>
		</div>
		
	</div> 
 
			 
	<div class="col-md-6 col-lg-3">
		<div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
		<div class="info">
		  <a href="<?php echo base_url();?>index.php/BlockTransporterController/showPumpSummary"><h4>Distributors Summary</h4></a>
		  <p><b></b></p>
		</div>
		</div>
	</div>
	
	<div class="col-md-6 col-lg-3">
		<div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
		<div class="info">
		  <a href="#" data-toggle="modal" data-target="#requestModel"><h4>Contact Details</h4></a>
		  <p><b></b></p>
		</div>
		</div>
	</div>
		 
		
	 <?php 	
		$this->db->select('*');				
		$qu1=$this->db->get_where('associations',array('id'=>$parentId));
		$qurow1=$qu1->row();
		$assoName=$qurow1->association_name;
		$route_name=$qurow1->route_name;	 
		$person_name=$qurow1->person_name;	 
		$person_email=$qurow1->person_email;	 
		$person_phone1=$qurow1->person_phone1;	 
		$person_phone2=$qurow1->person_phone2;	 
	?>	
	
	<div class="modal fade" id="requestModel">
	<div class="modal-dialog modal-lg modal-dialog-centered">
		<div class="modal-content">
		<!-- Modal Header -->
			<div class="modal-header">
			  <h2 class="modal-title" style="font-size:20px;color:red;">Association Details</h2>
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			
		<div class="modal-body">
			<div class="form-group row">
					<label class="control-label col-md-2"> Association Name: </label>
					<div class="col-md-4">	
					<b><?php echo $assoName;?>	</b>											
					</div>
					<label class="control-label col-md-2">Route Name : </label>
					<div class="col-md-4">	
					<b><?php echo $route_name;?> </b>											
					</div>
			</div>
				
			<div class="form-group row">
				<label class="control-label col-md-2"> President Name: </label>
				<div class="col-md-4">	
				<b><?php echo $person_name;?>	</b>											
				</div>
				<label class="control-label col-md-2">Person eMail : </label>
				<div class="col-md-4">	
				<b><?php echo $person_email;?> </b>											
				</div>
			</div>
				
			<div class="form-group row">
				<label class="control-label col-md-2"> Person phone No1: </label>
				<div class="col-md-4">	
				<b><?php echo $person_phone1;?>	</b>											
				</div>
				<label class="control-label col-md-2">Person phone No2 : </label>
				<div class="col-md-4">	
				<b><?php echo $person_phone2;?> </b>											
				</div>
			</div>
		</div>
			
			<!-- Modal footer -->
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
	</div>
	 
	<?php } } ?>
	</div>
	
   
	
<!-- <hr> -->
 
 
<div class="row">
<!--<div class="col-md-6 col-lg-3">
	  <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
		<div class="info">
		  <h4>Send Email</h4>
		  <p><b></b></p>
		</div>
	  </div>
	</div>-->
</div> 
	
	
  </main>
  </body>
    <!-- Modal -->
  <div class="modal fade" id="SMSModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
        	<center><h5>Send SMS</h5></center>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        </div>
		 <!-- <center><h5>Send SMS</h5></center> -->
        <div class="modal-body">
          <div class="col-md-10" data-toggle="modal" data-target="#SMSModal">
				
				
				<div>
					<a href="<?php echo base_url();?>index.php/SMSController/SingleSMS_create">
						<img class="img-responsive small-big" src="<?php echo base_url();?>assets/img/send_single_btn.png"></a>
				</div>
				<div>			
				<a href="<?php echo base_url();?>index.php/SMSController/AllSMS_create">
						<img class="img-responsive small-big" src="<?php echo base_url();?>assets/img/send_toall_btn.png"></a>
				</div>
			</div>
			
        </div>
       
      </div>
      
    </div>
  </div>
   <!-- End Modal -->
  
<?php include('includes/footer.php'); 
  } else{ ?><script>
window.location.href = "<?php echo base_url();?>";
</script><?php } ?>