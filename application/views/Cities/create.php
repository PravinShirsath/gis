<?php 
$uid=$this->session->userdata('userid');
if(isset($uid))
{
	include('includes/topbar.php');
	include('includes/header.php');
	//include('includes/sidebar.php');
	$regionId='';
if(isset($singlecities))
{
 $singlecity=$singlecities['singlecities']->row();	
 $name=$singlecity->name;
 $regionId=$singlecity->regionId;
 $id=$singlecity->id;
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
			<h5 style="margin-left:30px;"><a href="<?php echo base_url();?>index.php/CitiesController/create"><button style="background-color:powderblue;COLOR:black">Add City</button></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/CitiesController/activelist"><button>Active City list</button></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/CitiesController/deactivatelist"><button>Deactive City list</button></a></h5>
		</div>
	<div class="col-md-12">
	<div class="tile">
		<div class="tile-body">
		<form class="form-horizontal" action="<?php echo base_url();?>index.php/CitiesController/store" method="post" data-parsley-validate data-toggle="validator">
			<div class="form-group row">
			<label class="control-label col-md-2">Regions</label>
			<div class="col-md-4">
			<select class="form-control" placeholder="Pick Region" name="region" required data-parsley-required-message="Region name cannot be blank">
			<option value="">Select Region</option>
			 <?php if(isset($regions)){	
				foreach($regions['regions'] as $region){ ?>                                    
				<option <?=( $region->id == $regionId ? 'selected=""' : '')?> value="<?php echo $region->id; ?>"><?php echo $region->name; ?></option>
				<?php }  } ?>
			</select>
			</div>
			<label class="control-label col-md-2"><strong>Add City</strong></label>
			<div class="col-md-4">
			<input class="form-control" type="text" name="name" placeholder="Add City Name" value="<?php if(isset($name)){echo $name;}?>" required data-parsley-required-message="City name cannot be blank">
			<input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}?>" >
			</div>
			</div>
			 
		<div class="tile-footer">
		<div class="row">
		<div class="col-md-8 col-md-offset-3">
		<?php
		if(isset($id))
		{ ?>
		<button class="btn btn-primary" type="submit" name="Edit">
		<i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;&nbsp;&nbsp;
		<?php }else { ?>		
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


<?php } else{ ?><script>
window.location.href = "<?php echo base_url();?>";
</script><?php } ?>