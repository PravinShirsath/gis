<?php 
$uid=$this->session->userdata('userid');
if(isset($uid))
{
include('includes/topbar.php');
include('includes/header.php');
//include('includes/sidebar.php');	 
if(isset($singleassociations))
{
 $singleassociation=$singleassociations['singleassociations']->row();	
 $name=$singleassociation->association_name;
 $route_name=$singleassociation->route_name;
 $person_name=$singleassociation->person_name;
 $person_email=$singleassociation->person_email;
 $person_phone1=$singleassociation->person_phone1;
 $person_phone2=$singleassociation->person_phone2;
 $id=$singleassociation->id;
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
			<h5 style="margin-left:30px;"><a href="<?php echo base_url();?>index.php/AssociationController/create"><button style="background-color:powderblue;COLOR:black">Add Association</button></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/AssociationController/activelist"><button>Active Association list</button></a>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/AssociationController/deactivatelist"><button>Deactive Association list</button></a></h5>
		</div>
		<div class="col-md-12">
			<div class="tile">
				<div class="tile-body">
					<form class="form-horizontal" data-parsley-validate data-toggle="validator" method="POST" Action="<?php echo base_url();?>index.php/AssociationController/store">
						<div class="form-group row">
							<label class="control-label col-md-3"><strong>Association ADMIN Details</strong></label>
						</div>
						<div class="form-group required row">
						<label class="control-label col-md-2">Admin Name<span style="color:red">*</span></label>
							<div class="col-md-4">
								<input class="form-control" type="text" value="<?php if(isset($person_name)){echo $person_name;}?>" name="person_name" placeholder="Admin Name" required data-parsley-required-message="Person name cannot be blank">
							</div>
						</div>
						<div class="form-group row">
						<label class="control-label col-md-2">Admin E-mail<span style="color:red">*</span></label>
							<div class="col-md-4">
								<input class="form-control" type="text" <?php if(isset($id)){ ?> readonly <?php } ?> value="<?php if(isset($person_email)){echo $person_email;}?>" name="person_email" placeholder="Admin E-mail" required data-parsley-required-message="Email ID cannot be blank">
							</div>	
						</div>
						<div class="form-group row">
						<label class="control-label col-md-2">Admin Mobile 1<span style="color:red">*</span></label>		 
							<div class="col-md-4">
								<input class="form-control" type="text" value="<?php if(isset($person_phone1)){echo $person_phone1;}?>" name="person_phone1" placeholder="Admin Mobile 1" required data-parsley-type="number"
                                    data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10,10]" data-parsley-required-message="Mobile Number cannot be blank">
							</div>			
						</div>

						<div class="form-group row">
							<label class="control-label col-md-2">Admin Mobile 2</label>		 
							<div class="col-md-4">
								<input class="form-control" type="text" value="<?php if(isset($person_phone2)){echo $person_phone2;}?>" name="person_phone2" placeholder="Admin Mobile 2"  data-parsley-type="number"
                                    data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10,10]" data-parsley-required-message="Mobile Number cannot be blank">
							</div>			
						</div>

						<div class="form-group row">
							<label class="control-label col-md-2">Association Name<span style="color:red">*</span></label>
							<div class="col-md-4">
								<input class="form-control" name="association_name" type="text" value="<?php if(isset($name)){echo $name;}?>" placeholder="Enter Association Name" required data-parsley-required-message="Association name cannot be blank">
							</div>
						</div>

						<div class="form-group row">			
							<label class="control-label col-md-2">Route Name<span style="color:red">*</span></label>
							<div class="col-md-4">
								<input class="form-control" name="route_name" value="<?php if(isset($route_name)){echo $route_name;}?>" type="text" placeholder="Enter Route Name" required data-parsley-required-message="Route name cannot be blank">
							</div>
						</div>			

						<div class="row">
							<div class="col-md-8 col-md-offset-3">
								<?php
									if(isset($id))
									{ ?>
										<input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}?>">
										<button class="btn btn-primary" type="submit" name="edit">
											<i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;&nbsp;&nbsp;
										<?php
									}
									else
									{?>
										<button class="btn btn-primary" type="submit" onClick = "this.style.visibility= 'hidden';" name="save">
											<i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;
								<?php 
									}?>
										<a class="btn btn-secondary" href="<?php echo base_url();?>index.php/Welcome">
										<i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
							</div>
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