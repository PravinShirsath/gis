<?php 
$uid=$this->session->userdata('userid');
if(isset($uid))
{	 
include('includes/topbar.php');
 include('includes/header.php');
 //include('includes/sidebar.php');
if(isset($singleRegion))
{
 $singleRegions=$singleRegion['singleRegion']->row();	
 $name=$singleRegions->name;
 $id=$singleRegions->id;
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
			<h5 style="margin-left:30px;"><a href="<?php echo base_url();?>index.php/RegionsController/create"><button style="background-color:powderblue;COLOR:black">Add Region</button></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/RegionsController/activelist"><button>Active Region list</button></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/RegionsController/deactivatelist"><button>Deactive Region list</button></a></h5>
		</div>
	<div class="col-md-12">
	<div class="tile">
		<div class="tile-body">
		<form class="form-horizontal" action="<?php echo base_url();?>index.php/RegionsController/store" method="post" data-parsley-validate data-toggle="validator">
		<div class="form-group row">
		<label class="control-label col-md-2">Add Regions</label>
		<div class="col-md-4">
		<input class="form-control" name="name" type="text" value="<?php if(isset($name)){echo $name;}?>" placeholder="Enter Region Name" required data-parsley-required-message="Region name cannot be blank">
		</div>
		</div>
        <input  name="id" type="hidden" value="<?php if(isset($id)){echo $id;}?>">
		<div class="tile-footer">
		<div class="row">
		<div class="col-md-8 col-md-offset-3">
		<?php
		if(isset($id))
		{?>
		<button class="btn btn-primary" type="submit" name='Edit'>
		<i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;&nbsp;&nbsp;
		<?php } else { ?>
		<button class="btn btn-primary" type="submit" name='Save' onClick = "this.style.visibility= 'hidden';">
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
function discardregion(value)
{
if(confirm("Sure to Discard record !!!") == true)
{
$.ajax({
type: 'post',
url: '<?php echo base_url();?>index.php/RegionsController/discard',
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