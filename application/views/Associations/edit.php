<?php 
$uid=$this->session->userdata('userid');
$role=$this->session->userdata('role');
if(isset($uid))
{
	include('includes/topbar.php'); 
    include('includes/header.php'); 
  //include('includes/sidebar.php');
  if(isset($singlepumps))
  {
	  foreach($singlepumps['singlepumps'] as $profiledata)
	  {
		  $name=$profiledata->name;
		  $mobileNo=$profiledata->mobileNo;
		  $email=$profiledata->email;
		  $id=$profiledata->id;
		  $ccode=$profiledata->ccode;
		  $ownerName=$profiledata->ownerName;
		  $address=$profiledata->address;
		  $companyId=$profiledata->companyId;
		  $regionId=$profiledata->regionId;
		  $cityId=$profiledata->cityId;
		  $mobileNo=$profiledata->mobileNo;
		  $mobile1=$profiledata->mobile1;
		  $mobile2=$profiledata->mobile2;
		  $associationId=$profiledata->associationid;
	  }
  } 

  if(isset($singleuser))
  {
	  //print_r($singleuser); die();
	  foreach($singleuser['singleuser'] as $singleusr)
	  {	 
	  $usermobileNo=$singleusr->mobile;
	  $useremail=$singleusr->username;
	  $userid=$singleusr->id;
	  $userownerName=$singleusr->name;	 
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
	<?php if($role == 'Association')
	{
        
	?>
	<div class="form-group row">
		<h5 style="margin-left:20px;">
			<a href="<?php echo base_url();?>index.php/PumpsController/create">
				<button style="background-color:powderblue;COLOR:black">Add Distributor</button>
			</a>
			<a href="<?php echo base_url();?>index.php/PumpsController">
				<button>Active Distributors list</button>
			</a>
			<a href="<?php echo base_url();?>index.php/PumpsController/deactivatelist">
				<button>Deactive Distributors list</button>
			</a>
			
			<a href="<?php echo base_url();?>index.php/PumpsController/activationpendinglist"><button>Activation Pending list</button></a></h5>
		</h5>
	</div>
	<?php } ?>
    <div class="row">
        <div class="col-md-12">         
               
                    <?php if($role=='Association') { ?>
                        <div class="tile">
					 <div class="tile-body">
             
                    <form class="form-horizontal" action="<?php echo base_url();?>index.php/PumpsController/StoreforAL" method="post" data-parsley-validate="true">
                        <div class="form-group row">
                            <label class="control-label col-md-2">Distributor Owner Name
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" value="<?php if(isset($userownerName)){ echo $userownerName; }?>" placeholder="Enter Distributor Owner Name" name="Ownername" required data-parsley-required-message="Distributor name cannot be blank">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Mobile Number
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" value="<?php if(isset($usermobileNo)){ echo $usermobileNo; }?>" placeholder="Enter Mobile Number1" name="Mobile" required data-parsley-type="number"
                                    data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10,10]" data-parsley-required-message="Mobile Number cannot be blank">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">eMail-Id
                                <span style="color:red">* (Add Correct Email ID only, It can not be changed)</span>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control" value="<?php if(isset($useremail)){ echo $useremail; }?>" type="email" placeholder="Enter eMailId" name="eMailId" required data-parsley-required-message="EmailId cannot be blank">
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="control-label col-md-2">Select Zone</label>
                            <div class="col-md-4">
                                <select class="form-control" name="zonename" placeholder="Pick a Zone" id="zone"  required 
                                    data-parsley-required-message="Zone name cannot be blank">
                                    <?php if(isset($regions)){	
                                    foreach($zone['zone'] as $zone){?>                                    
                                    <option <?=( $zone->id == $zone ? 'selected=""' : '')?> value="<?php echo $zone->id; ?>"><?php echo $zone->zonename; ?></option>
                                    <?php }  } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label class="control-label col-md-2">Distributor Name
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-4">
                            <input class="form-control" type="text" value="<?php if(isset($name)){ echo $name; }?>" placeholder="Enter Distributor Name" name="pumpname"
                                    required  data-parsley-required-message="Distributor name cannot be blank">
                            </div>
                        </div>                   



                        <div class="tile-footer">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-3">
								<?php
									if(isset($userid))
									{ ?>
										<input type="hidden" name="userid" value="<?php if(isset($userid)){echo $userid;}?>">
										<input type="hidden" name="useremail" value="<?php if(isset($useremail)){echo $useremail;}?>">
										<input type="hidden" name="usermobileNo" value="<?php if(isset($usermobileNo)){echo $usermobileNo;}?>">
										<input type="hidden" name="userownerName" value="<?php if(isset($userownerName)){echo $userownerName;}?>">
										<button class="btn btn-primary" type="submit" name="edit">
											<i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;&nbsp;&nbsp;
										<?php
									}
									else
									{?>
								
                                    <button class="btn btn-primary" type="submit" name="save">
									<i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;<?php } ?>
                                    <a class="btn btn-secondary" href="<?php echo base_url();?>index.php/Welcome">
                                        <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                    </div>
                    <?php } ?>
                    <?php if($role=='Pumps') { ?>
                    <div class="tile">
					<div class="tile-body">
                    <h5 style="color:red;">
                        <u>Update Profile</u>
                    </h5>
                    <form action="<?php echo base_url();?>index.php/PumpsController/UpdatePumpProfile" method="post"
                        data-parsley-validate data-toggle="validator">
                       <input type="hidden" value="<?php if(isset($associationId)){ echo $associationId;}?>" name="associationId">
                        <div class="form-group row">
								 <?php if(empty($ccode)){  ?>
								<label class="control-label col-md-2">Customer Code
								<span style="color:red">*</span>
								</label>
								<div class="col-md-4">
								<input class="form-control" type="text" placeholder="Enter Customer Code" name="ccode" required 
								data-parsley-required-message="Agency name cannot be blank" autocomplete="off">
								</div>                      
								<?php } else { ?>
								<label class="control-label col-md-2">Customer Code
								<span style="color:red">*</span>
								</label>
								<div class="col-md-4">  
								<input class="form-control" type="readonly" name="oldCCode" value="<?php if(isset($ccode)){echo $ccode;} ?>">
								</div>
								<?php } ?>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Distributor Owner Name
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control" value="<?php if(isset($ownerName)){ echo $ownerName; }?>" type="text" placeholder="Enter Owner Name"
                                    name="Ownername" required  data-parsley-required-message="Agency name cannot be blank">
                            </div>

                            <label class="control-label col-md-2">Distributor Name
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" value="<?php if(isset($name)){ echo $name; }?>" placeholder="Enter Agency Name" name="pumpname"
                                    required  data-parsley-required-message="Agency name cannot be blank">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Select Gas Company
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-4">
                                <select class="form-control" placeholder="Pick a Company" name="Company" required  data-parsley-required-message="Company name cannot be blank">
                                
                                <option value="">Select</option>                                                                        
                                    <?php if(isset($company)){                                        
                                        foreach($company['company'] as $companys){
                                    ?>
                                    <option <?=( $companys->id == $companyId ? 'selected=""' : '')?> value="<?php echo $companys->id; ?>"><?php echo $companys->name; ?></option>
                                    
                                    <?php } } ?>
                                </select>
                            </div>
                            <label class="control-label col-md-2">Select Region
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-4">
                                <select class="form-control" placeholder="Pick a Region" id="regions" name="regions" required 
                                    data-parsley-required-message="Regions name cannot be blank">
                                    <?php if(isset($regions)){	
                                    foreach($regions['regions'] as $region){?>                                    
                                    <option <?=( $region->id == $regionId ? 'selected=""' : '')?> value="<?php echo $region->id; ?>"><?php echo $region->name; ?></option>
                                    <?php }  } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Mobile Number
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" value="<?php if(isset($mobileNo)){ echo $mobileNo;}?>" placeholder="Enter Mobile Number1"
                                    name="Mobile" required  data-parsley-type="number" data-parsley-pattern="^[7-9][0-9]{9}$"
                                    data-parsley-length="[10,10]" data-parsley-required-message="Mobile Number cannot be blank">
                            </div>
                            <label class="control-label col-md-2">Select City
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-4">
                                <select class="form-control" placeholder="Pick a City" id="cityId" name="cityId"  required data-parsley-required-message="City name cannot be blank"
                                    >
                                    <?php if(isset($cityId)){
                                      $city= $this->db->get_where('cities',array('id'=>$cityId)); $city=$city->row();	?>                                                                     
                                    <option value="<?php echo $city->id;?>"><?php echo $city->name;?></option>
                                    <?php }   ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="control-label col-md-2">Alternate Mobile1</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" value="<?php if(isset($mobile1)){ echo $mobile1; }?>" placeholder="Enter Mobile Number1"
                                    name="Mobile1" data-parsley-type="number" data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10,10]"
                                    data-parsley-required-message="Mobile Number cannot be blank">
                                <input type="hidden" value="<?php if(isset($id)){ echo $id; }?>" name="id">
                            </div>
                            <label class="control-label col-md-2">Pin Code</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" placeholder="Enter Pin Code" value="<?php if(isset($PINCode)){ echo $PINCode; }?>"
                                    name="pincode" data-parsley-type="number" data-parsley-length="[6,6]" data-parsley-required-message="PinCode name cannot be blank">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-2">Alternate Mobile3</label>
                            <div class="col-md-4">
                                <input class="form-control" type="text" value="<?php if(isset($mobile2)){ echo $mobile2; }?>" placeholder="Enter Mobile Number2"
                                    name="Mobile2" data-parsley-type="number" data-parsley-pattern="^[7-9][0-9]{9}$" data-parsley-length="[10,10]"
                                    data-parsley-required-message="Mobile Number cannot be blank">
                            </div>
                            <label class="control-label col-md-2">Address
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-4">
                                <textarea class="form-control" type="text" placeholder="Enter Address" name="Address" required 
                                    data-parsley-required-message="Address cannot be blank"><?php if(isset($address)){ echo $address; }?></textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="control-label col-md-2">eMail-Id
                                <span style="color:red">*</span>
                            </label>
                            <div class="col-md-4">
                                <input class="form-control" type="email" readonly value="<?php if(isset($email)){ echo $email; }?>" placeholder="Enter eMailId"
                                    name="eMailId" required data-parsley-required-message="EmailId cannot be blank">
                            </div>
                        </div>


                        <div class="tile-footer">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-3">
                                    <button class="btn btn-primary" type="submit" name="update">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>&nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-secondary" href="<?php echo base_url();?>index.php/Welcome">
                                        <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                     </div>
                     </div>
                    <?php } ?>

               
            
        </div>
        <div class="clearix"></div>
    </div>
</main>
<?php include('includes/footer.php');?>
<script type="text/javascript"> 
    $('#regions').bind("change", function () {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url();?>index.php/PumpsController/getcities",
            data: { regionid: $('#regions').val() },
            success: function (html) {
                $("#cityId").html(html);
            }
        });
    });
</script>
<?php } else{ ?>
<script>
    window.location.href = "<?php echo base_url();?>";
</script>
<?php } ?>