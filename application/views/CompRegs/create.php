<?php 
$uid=$this->session->userdata('userid');
if(isset($uid))
{
include('includes/topbar.php');
include('includes/header.php');
 //include('includes/sidebar.php');

if(isset($singlecompany))
{
	foreach($singlecompany as $comp)
	{
	//$comp=$singlecompany['singlecompany'];
	$name=$comp->name;
	$designation=$comp->designation;
	$mobileNo=$comp->mobNumber;
	$email=$comp->eMailId;
	$id=$comp->id;
	$companyId=$comp->companyId;
	$officeId=$comp->officeId;
	}
}
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
				<h5 style="margin-left:30px;"><a href="<?php echo base_url();?>index.php/CompRegistrationController/create"><button style="background-color:powderblue;COLOR:black">Comp Registration</button></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/CompRegistrationController/activelist"><button>Active Comp Registration list</button></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/CompRegistrationController/deactivatelist"><button>Deactive Comp Registration list</button></a></h5>
		</div>

	<div class="col-md-12">
	<div class="tile">
	<div class="tile-body">
	<form class="form-horizontal" action="<?php echo base_url();?>index.php/CompRegistrationController/store" method="post" data-parsley-validate data-toggle="validator">
	
	<div class="form-group row">
		<label class="control-label col-md-2">Select Company</label>
		<div class="col-md-4">
			<select class="form-control" name="compName" placeholder="Pick a Company" id="zone"  required 
				data-parsley-required-message="Company name cannot be blank">
				<?php if(isset($company)){	
					if(isset($companyId)){
						$this->db->select('name');	
						$this->db->where('id',$companyId);
						$qu=$this->db->get('companies');
						$qurow=$qu->row();
						
						?><option value="<?php echo $companyId; ?>"><?php  echo $qurow->name; ?></option><?php
					}
					foreach($company['company'] as $companys){?>                                    
					<option <?=( $companys->id == $companys ? 'selected=""' : '')?> value="<?php echo $companys->id; ?>"><?php echo $companys->name; ?>
					</option>
					<?php }  } ?>
			</select>

		</div>
	</div>

	<div class="form-group row">
		<label class="control-label col-md-2">Select Office</label>
		<div class="col-md-4">
		<select class="form-control" name="OfficeName" placeholder="Pick a Office Name" id="zone"  required 
			data-parsley-required-message="Office name cannot be blank">
			<?php if(isset($office)){	
				if(isset($officeId)){
					$this->db->select('name');	
					$this->db->where('id',$officeId);
					$qu=$this->db->get('stateoffice');
					$qurow=$qu->row();
					
					?><option value="<?php echo $officeId; ?>"><?php  echo $qurow->name; ?></option><?php
				}
				foreach($office['office'] as $offices){?>                                    
				<option <?=( $offices->id == $offices ? 'selected=""' : '')?> value="<?php echo $offices->id; ?>"><?php echo $offices->name; ?>
				</option>
			<?php }  } ?>
		</select>
		</div>
	</div>

	<div class="form-group row">
		<label class="control-label col-md-2">Name</label>
		<div class="col-md-4">
			<input class="form-control" name="name" type="text" placeholder="Enter Name" value="<?php if(isset($name)){echo $name;}?>" required data-parsley-required-message="Name cannot be blank">
			<input  name="id" type="hidden" value="<?php if(isset($id)){echo $id;}?>">
		</div>			 
	</div>

	<div class="form-group row">
		<label class="control-label col-md-2">Designation</label>
		<div class="col-md-4">
			<input class="form-control" name="designation" type="text" placeholder="Enter Designation" value="<?php if(isset($designation)){echo $designation;}?>" required data-parsley-required-message="Designation cannot be blank">
			<input  name="id" type="hidden" value="<?php if(isset($id)){echo $id;}?>">
		</div>			 
	</div>

	<div class="form-group row">
		<label class="control-label col-md-2">Mobile Number</label>
		<div class="col-md-4">
			<input class="form-control" type="text" value="<?php if(isset($mobileNo)){ echo $mobileNo;}?>" placeholder="Enter Mobile Number"
			name="Mobile" required  data-parsley-type="number" data-parsley-pattern="^[7-9][0-9]{9}$"
			data-parsley-length="[10,10]" data-parsley-required-message="Mobile Number cannot be blank">
		</div>			 
	</div>
	
	<div class="form-group row">
		<label class="control-label col-md-2">Email Id</label>
		<div class="col-md-4">
			<input class="form-control" type="email"  value="<?php if(isset($email)){ echo $email; }?>" placeholder="Enter eMailId"
			name="eMailId" required data-parsley-required-message="EmailId cannot be blank">
		</div>		 
	</div>

	<div class="tile-footer">
	<div class="row">
			<div class="col-md-8 col-md-offset-3">
			<?php
				if(isset($id))
			{	?>
			<button class="btn btn-primary" type="submit" name="Edit">
			<i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;&nbsp;&nbsp;
			<?php }else{ ?>
			<button class="btn btn-primary" type="submit" name="Save">
			<i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;
			<?php } ?>
			<a class="btn btn-secondary" href="<?php echo base_url();?>index.php/Welcome">
			<i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
			</div>
		</div>
		</div>
	</form>
	</div>	
	</div>
	</div>
	
</main>
<?php include('includes/footer.php');?>
<script>
$('#sampleTable').DataTable();
function discardCompany(value)
{
if(confirm("Sure to delete record !!!") == true)
{
$.ajax({
type: 'post',
url: '<?php echo base_url();?>index.php/CompaniesController/discard',
data: 'post_id=' + value,
success: function(data)
{
location.reload();
}
});
}
}
</script>
<?php } else{ ?><script>
window.location.href = "<?php echo base_url();?>";
</script><?php } ?>