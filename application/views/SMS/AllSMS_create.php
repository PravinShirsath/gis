<?php 
$uid=$this->session->userdata('userid');
if(isset($uid))
{
include('includes/topbar.php');
include('includes/header.php');
//include('includes/sidebar.php');	 

?>
<main class="app-content">
		<div class="app-title">
		<div>		
		<h1 style="margin-top:5px">
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url();?>index.php/Welcome"><button class="btn btn-danger">Dashboard </button></a>
            </h1>
		</div>
		</div>
	<div class="row">
		<div class="form-group row">
			<h5 style="margin-left:30px;"><a href="<?php echo base_url();?>index.php/SMSController/SingleSMS_create"><button>SMS to Single</button></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/SMSController/AllSMS_create"><button style="background-color:green;COLOR:white">SMS to All</button></a>
			</h5>
		</div>
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
					<form class="form-horizontal" data-parsley-validate data-toggle="validator" method="POST" Action="<?php echo base_url();?>index.php/SMSController/smsall">
						<div class="form-group row">
							<label class="control-label col-md-3"><strong>Send SMS to All</strong></label>
						</div>
						<div class="form-group required row">
						<label class="control-label col-md-2">Enter SMS<span style="color:red">*</span></label>
							<div class="col-md-4">
								<textarea class="form-control" type="text"  name="allsms" placeholder="Type your SMS" required data-parsley-required-message="SMS cannot be blank"></textarea>
							</div>
						</div>
						<div class="form-group required row">
						<button class="btn btn-primary" type="submit" onClick = "this.style.visibility= 'hidden';" name="save" style="margin-left:20%;">
											<i class="fa fa-fw fa-lg fa-check-circle"></i>SEND</button>&nbsp;&nbsp;&nbsp;
					<a href="<?php echo base_url();?>index.php/Welcome"><button class="btn btn-danger" type="button"  name="cancle">
											<i class="fa fa-close"></i>Cancel</button></a>&nbsp;&nbsp;&nbsp;
						</div>		
										
			<!--End row First-->		
					</form>
				</div>
			</div>
		</div>	
	</div>
</main>
<?php include('includes/footer.php');?>
<?php } else{ ?><script>
window.location.href = "<?php echo base_url();?>";
</script><?php } ?>