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
<h1><i class="fa fa-home"></i><a href="<?php echo base_url();?>index.php/Welcome">Dashboard</a></h1>
</div>
</div> 



	<div class="row">
	<div class="col-md-12">
		<div class="form-group row">
		<h5 style="margin-left:20px;"><a href="<?php echo base_url();?>index.php/PumpsController/createnew"><button style="background-color:powderblue;COLOR:black">Add Pump</button></a>
		<a href="<?php echo base_url();?>index.php/PumpsController"><button>Active Pump list</button></a>
		<a href="<?php echo base_url();?>index.php/PumpsController/deactivatelist"><button>Deactive Pump list</button></a></h5>
		</div>
	<div class="tile-body">
	<form class="form-horizontal" action="<?php echo base_url();?>index.php/PumpsController/Storenew" method="post" data-parsley-validate data-toggle="validator">
	<div class="form-group row">
	<label class="control-label col-md-2">Customer Code<span style="color:red">*</span></label>
	<div class="col-md-4">
	<input class="form-control" type="text" placeholder="Enter Customer Code" name="ccode" required data-parsley-required-message="Pump name cannot be blank">
	</div>
	</div>
<div class="form-group row">
<label class="control-label col-md-2">Select Petroleum Company<span style="color:red">*</span></label>
<div class="col-md-4">
<select class="form-control" placeholder="Pick a Company" name="Company" required data-parsley-required-message="Company name cannot be blank">
<option value="">Select</option>
<?php if(isset($company)){
foreach($company['company'] as $region){
?>							
<option value="<?php echo $region->id;?>"><?php echo $region->name;?></option>
<?php } } ?>
</select>
</div>
</div>
<div class="form-group row">
<label class="control-label col-md-2">Pump 	Owner Name<span style="color:red">*</span></label>
<div class="col-md-4">
<input class="form-control" type="text" placeholder="Enter Owner Name" name="Ownername" required data-parsley-required-message="Pump name cannot be blank">
</div>
</div>
<div class="form-group row">
<label class="control-label col-md-2">Pump Name<span style="color:red">*</span></label>
<div class="col-md-4">
<input class="form-control" type="text" placeholder="Enter Pump Name" name="pumpname" required data-parsley-required-message="Pump name cannot be blank">
</div>
</div>

<div class="form-group row">
<label class="control-label col-md-2">Mobile Number<span style="color:red">*</span></label>
<div class="col-md-4">
<input class="form-control" type="text" placeholder="Enter Mobile Number" name="Mobile" required  data-parsley-type="number"  data-parsley-pattern="^[7-9][0-9]{9}$"  data-parsley-length="[10,10]" data-parsley-required-message="Mobile Number cannot be blank">
</div>
</div>
<div class="form-group row">
<label class="control-label col-md-2">eMail-Id<span style="color:red">*</span></label>
<div class="col-md-4">
<input class="form-control" type="eMail" placeholder="Enter eMailId" name="eMailId" required data-parsley-required-message="EmailId cannot be blank">
<input class="form-control" type="hidden" placeholder="Enter eMailId" name="regions" required data-parsley-required-message="EmailId cannot be blank">
<input class="form-control" type="hidden" placeholder="Enter eMailId" name="cityId" required data-parsley-required-message="EmailId cannot be blank">
</div>
</div>




<div class="form-group row">
<!--<label class="control-label col-md-2">Select Association<span style="color:red">*</span></label>
<div class="col-md-4">
<select class="form-control" placeholder="Pick a Association" name="Association" required data-parsley-required-message="Association name cannot be blank">
<option value="">Select</option>
<?php if(isset($associations)){
foreach($associations['associations'] as $region){
?>							
<option value="<?php echo $region->id;?>"><?php echo $region->route_name;?></option>
<?php } } ?>
</select>
</div>	 -->
							
</div>

</div>
<div class="tile-footer">
<div class="row">
<div class="col-md-8 col-md-offset-3">
<button class="btn btn-primary" type="submit">
<i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;
<a class="btn btn-secondary" href="<?php echo base_url();?>index.php/Welcome">
<i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
</div>
</div>
</div>
</form>
</div>
</div>
<div class="clearix"></div>
</div>
</main>
<?php include('includes/footer.php');?>
<script type="text/javascript">
$('#regions').bind("change",function () {
			$.ajax({
		type: "GET", 
		url: "<?php echo base_url();?>index.php/PumpsController/getcities",
		data: {regionid : $('#regions').val()},
		success: function(html) {
		$("#cityId").html(html);
		}
		});
});
</script>
<?php } else{ ?><script>
window.location.href = "<?php echo base_url();?>";
</script><?php } ?>