<?php 
$uid=$this->session->userdata('userid');
if(isset($uid))
{
include('includes/topbar.php');
include('includes/header.php');
 //include('includes/sidebar.php');
	if(isset($singlestateoffice))
{
 $singlestateoffice=$singlestateoffice['singlestateoffice'];
 $satename=$singlestateoffice->name;
 $id=$singlestateoffice->id;
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
			<h5 style="margin-left:30px;"><a href="<?php echo base_url();?>index.php/StateOfficeController/create"><button style="background-color:powderblue;COLOR:black">Add Sate Office</button></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/StateOfficeController/activelist"><button>Active Sate Office list</button></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/StateOfficeController/deactivatelist"><button>Deactive Sate Office list</button></a></h5>
	</div>
	<div class="col-md-12">
	
	<div class="tile">
		<div class="tile-body">
		<form class="form-horizontal" action="<?php echo base_url();?>index.php/StateOfficeController/store" method="post" data-parsley-validate data-toggle="validator">
			<div class="form-group row">
			<label class="control-label col-md-2">Add Sate Office</label>
			<div class="col-md-4">
			<input class="form-control" name="name" type="text" placeholder="Enter Sate Name" value="<?php if(isset($satename)){echo $satename;}?>" required data-parsley-required-message="Sate name cannot be blank">
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
url: '<?php echo base_url();?>index.php/StateOfficeController/discard',
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