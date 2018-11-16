<?php 
$uid=$this->session->userdata('userid');
if(isset($uid))
{
include('includes/topbar.php');
include('includes/header.php');
 //include('includes/sidebar.php');
	if(isset($singlecompanys))
{
 $singlecompany=$singlecompanys['singlecompanys']->row();	
 $name=$singlecompany->name;
 $id=$singlecompany->id;
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
			<h5 style="margin-left:30px;"><a href="<?php echo base_url();?>index.php/CompaniesController/create"><button style="background-color:powderblue;COLOR:black">Add Companies</button></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/CompaniesController/activelist"><button>Active Companies list</button></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/CompaniesController/deactivatelist"><button>Deactive Companies list</button></a></h5>
		</div>
	<div class="col-md-12">
	
	<div class="tile">
		<div class="tile-body">
		<form class="form-horizontal" action="<?php echo base_url();?>index.php/CompaniesController/store" method="post" data-parsley-validate data-toggle="validator">
			<div class="form-group row">
			<label class="control-label col-md-2">Add Fuel Company</label>
			<div class="col-md-4">
			<input class="form-control" name="name" type="text" placeholder="Enter Fuel Company" value="<?php if(isset($name)){echo $name;}?>" required data-parsley-required-message="Company name cannot be blank">
			<input  name="id" type="hidden" value="<?php if(isset($id)){echo $id;}?>">
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
			<button class="btn btn-primary" type="submit" onClick = "this.style.visibility= 'hidden';" name="Save">
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
	<div class="clearix"></div>
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