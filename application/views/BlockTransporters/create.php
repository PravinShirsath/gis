<?php 
 $uid=$this->session->userdata('userid');
if(isset($uid))
{
include('includes/topbar.php');
include('includes/header.php'); 
//include('includes/sidebar.php');
if(isset($singledefaulters))
{
	foreach($singledefaulters['singledefaulters'] as $singledefaulter)
	{
		$person_name=$singledefaulter->person_name;
		$company_name=$singledefaulter->company_name;
		$aadharno=$singledefaulter->aadharno;
		$panno=$singledefaulter->panno;
		$regionid=$singledefaulter->region;
		$city=$singledefaulter->city;
		$email=$singledefaulter->email;
		$address=$singledefaulter->address;
		$mobile1=$singledefaulter->mobile1;
		$mobile2=$singledefaulter->mobile2;
		$mobile3=$singledefaulter->mobile3;
		$mobile4=$singledefaulter->mobile4;
		$pending_amount=$singledefaulter->pending_amount;
		$remarks=$singledefaulter->remarks;
		$default_date=$singledefaulter->default_date;
		$id=$singledefaulter->id;
	}
}
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.3.2.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;
		
    $("#addButton").click(function () {
				
	if(counter>5){
            alert("Only 5 persons allow");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
                
	newTextBoxDiv.after().html('<label>Person Name'+ counter + ' : </label>' +
	      '<input type="text" class="form-control input-lg" placeholder="Enter Person Name" name="textbox' + counter + 
	      '" id="textbox' + counter + '" value="" >');
            
	newTextBoxDiv.appendTo("#TextBoxesGroup");

				
	counter++;
     });

     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
	counter--;
			
        $("#TextBoxDiv" + counter).remove();
			
     });
		
     $("#getButtonValue").click(function () {
		
	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
</script>
<!-- Mobile Script-->
<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;
		
    $("#addMobile").click(function () {
				
	if(counter>5){
            alert("Only 5 Mobile allow");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr("id", 'TextBoxDiv' + counter);
                
	newTextBoxDiv.after().html('<label>Mobile'+ counter + ' : </label>' +
	      '<input type="text" class="form-control input-lg" placeholder="Enter Mobile Number" name="mobile' + counter + 
	      '" id="mobile' + counter + '" value="" >');
            
	newTextBoxDiv.appendTo("#TextBoxesGroup1");

				
	counter++;
     });

     $("#removeMobile").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
	counter--;
			
        $("#TextBoxDiv" + counter).remove();
			
     });
		
     $("#getButtonValue").click(function () {
		
	var msg = '';
	for(i=1; i<counter; i++){
   	  msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
	}
    	  alert(msg);
     });
  });
</script>
<!-- End Mobile Script-->
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
		<div class="col-md-12">
			<div class="form-group row">
				<h5 style="margin-left:20px;">
					<a href="<?php echo base_url();?>index.php/BlockTransporterController/create"><button style="background-color:powderblue;COLOR:black">Add My Defaulter</button></a>
					<a href="<?php echo base_url();?>index.php/BlockTransporterController/myDefaulterList"><button>My Defaulter list</button></a>
					<!-- <a href="<?php echo base_url();?>index.php/BlockTransporterController/allDefaulterList"><button>All Defaulter list</button></a> -->
				</h5>
			</div>
			<div class="tile">
				<div class="tile-body">
					<form class="form-horizontal" method="POST" action="<?php echo base_url();?>index.php/BlockTransporterController/Store" data-parsley-validate data-toggle="validator" enctype='multipart/form-data'>
						<div class="form-group row">
						 <label class="control-label col-md-2">Defaulter Party Company Name<span style="color:red">*</span></label>
							<div class="col-md-4">
								<input class="form-control" type="text" name="company_name" placeholder="Defaulter Party Company Name" value="<?php if(isset($company_name)){echo $company_name;}?>" required data-parsley-required-message="Company name cannot be blank">
							</div>
							<label class="control-label col-md-2">Person Name<span style="color:red">*</span></label>
							<div class="col-md-4" id='TextBoxesGroup'>
								<input class="form-control" type="text" id='textbox1' placeholder="Enter Person Name" name="person_name" value="<?php if(isset($person_name)){echo $person_name;}?>" required data-parsley-required-message="Person name cannot be blank">
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-md-10">
							
							</div>
							<div class="col-md-2" style="float:right">
							<button class="btn" id='addButton'><i class="fa fa-plus"></i></button>
							<button class="btn"id='removeButton'><i class="fa fa-minus"></i></button>
							</div>

								<!--<input type='button' value='Get TextBox Value' id='getButtonValue'>	-->
						</div>
							<div class="form-group row">
							<label class="control-label col-md-2">Select State<span style="color:red">*</span></label>
							<div class="col-md-4">
								<select class="form-control" placeholder="Pick a Region" id="regions" name="regions" required data-parsley-required-message="Regions name cannot be blank">
									<?php 
										if(isset($regionid))
										{
											$this->db->select('name');				
											$this->db->where(array('id'=>$regionid));	
											$query=$this->db->get('regions');
											$regionName=$query->result();
											if(isset($regionName))
											{
												foreach($regionName as $region)
												{			 
											?><option value="<?php echo $regionid; ?>"><?php echo $region->name;?></option>
											<?php 
												}   
											}  
										}      
										?>	
									<?php if(isset($regions)){
									foreach($regions[regions] as $region){		 	
										if(isset($regionid))
										{ if($regionid == $region->id){
												?>
												<option value="<?php echo $regionid; ?>"><?php echo $region->name; ?></option>
												<?php 
											}} 
											?>
												
									<option value="<?php echo $region->id;?>"><?php echo $region->name;?></option>
									<?php } } ?>
									<option value="">Pick A Region</option>	
								</select>
							</div>
							<label class="control-label col-md-2">Select District<span style="color:red">*</span></label>
							<div class="col-md-4">
								<select class="form-control" placeholder="Pick a City" id="cityId" name="city" required data-parsley-required-message="City name cannot be blank">							 
									<?php 
									if(isset($city))
									{
										$this->db->select('name');				
										$this->db->where(array('id'=>$city));	
										$query=$this->db->get('cities');
										$cityname=$query->result();
										if(isset($cityname))
										{
											foreach($cityname as $city)
											{			 
										?><option value="<?php echo $regionid; ?>"><?php echo $city->name;?></option>
										<?php 
											}   
										}  
									}      
									?>	
								</select>
							</div>
						</div>
						
							<div class="form-group row">
						 <label class="control-label col-md-2">Aadhar No</label>
							<div class="col-md-4">
								<input class="form-control" type="text" name="aadharno" placeholder="Enter Aadhar No" value="<?php if(isset($aadharno)){echo $aadharno;}?>">
							</div>
							<label class="control-label col-md-2">PAN No</label>
							<div class="col-md-4" id='TextBoxesGroup'>
								<input class="form-control" type="text" id='textbox1' placeholder="Enter PAN No" name="panno" value="<?php if(isset($panno)){echo $panno;}?>">
							</div>
						</div>
						
						<div class="form-group row">
							<label class="control-label col-md-2">Email ID</label>
							<div class="col-md-4">
								<input class="form-control" name="email" value="<?php if(isset($email)){echo $email;}?>" type="text" placeholder="Enter Email ID">
							</div>
							<label class="control-label col-md-2">Party Address <span style="color:red">*</span></label>
							<div class="col-md-4">
								<textarea class="form-control" type="text" placeholder="Enter Address" name="address" required data-parsley-required-message="Address cannot be blank"><?php if(isset($address)){echo $address;}?></textarea>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="control-label col-md-2">Mobile1<span style="color:red">*</span></label>
							<div class="col-md-4" id='TextBoxesGroup1'>
								<input class="form-control" type="number" placeholder="Mobile1" name="mobile1" value="<?php if(isset($mobile1)){echo $mobile1;}?>" required  data-parsley-type="number"  data-parsley-pattern="^[7-9][0-9]{9}$"  data-parsley-length="[10,10]" data-parsley-required-message="Mobile Number cannot be blank">
							</div>
								
							
							<div class="col-md-4" style="float:right">
							<button class="btn" id='addMobile'><i class="fa fa-plus"></i></button>
							<button class="btn"id='removeMobile'><i class="fa fa-minus"></i></button>
							</div>

								<!--<input type='button' value='Get TextBox Value' id='getButtonValue'>	-->
						
							<!-- <label class="control-label col-md-2">Mobile2</label>
							<div class="col-md-4">
								<input class="form-control" type="number" placeholder="Mobile2" name="mobile2"  value="<?php if(isset($mobile2)){echo $mobile2;}?>" data-parsley-type="number"  data-parsley-pattern="^[7-9][0-9]{9}$"  data-parsley-length="[10,10]" data-parsley-required-message="Mobile Number cannot be blank">
							</div> -->
						</div>
						
						<!--<div class="form-group row">
							<label class="control-label col-md-2">Mobile3</label>
							<div class="col-md-4">
								<input class="form-control" type="number" placeholder="Mobile3" name="mobile3"   value="<?php if(isset($mobile3)){echo $mobile3;}?>" data-parsley-type="number"  data-parsley-pattern="^[7-9][0-9]{9}$"  data-parsley-length="[10,10]" data-parsley-required-message="Mobile Number cannot be blank">
							</div>
							<label class="control-label col-md-2">Mobile4</label>
							<div class="col-md-4">
								<input class="form-control" type="number" placeholder="Mobile4" name="mobile4"  value="<?php if(isset($mobile4)){echo $mobile4;}?>" data-parsley-type="number"  data-parsley-pattern="^[7-9][0-9]{9}$"  data-parsley-length="[10,10]" data-parsley-required-message="Mobile Number cannot be blank">
							</div>
						</div>-->
						
						<div class="form-group row">
							<label class="control-label col-md-2">Defaulter since<span style="color:red">*</span></label>
							<div class="col-md-4">
								<input class="form-control" name="defaultdate" id="date" max='<?php echo date('Y-m-d');?>' type="date" onkeypress='return false' value="<?php if(isset($default_date)){echo $default_date;}?>" required data-parsley-required-message="default date cannot be blank">
							</div>
							<label class="control-label col-md-2">Pending Amount(Rs.)<span style="color:red">*</span></label>
							<div class="col-md-4">
								<input type="text" name="number" value="<?php if(isset($pending_amount)){echo $pending_amount;}?>" class="form-control" maxlength="9" placeholder="Pending Amount(Rs.)" onkeypress='return event.charCode >= 48 && event.charCode <= 57' onkeyup="word.innerHTML=convertNumberToWords(this.value)" autocomplete="off" required/>
							</div>													
						</div>	

						<div class="form-group row">
						<label class="control-label col-md-2">No. of Days</label>
							<div class="col-md-4">
								<input type="text" name="noofdays" id="noofdays" class="form-control" placeholder="No. of Days" readonly/>
							</div>	
							
							<label class="control-label col-md-2">Pending Amount(Rs.)</label>
							<div class="col-md-4">
								<div id="word"></div>
							</div>				
						</div>	
						<div class="form-group row">
							<label class="control-label col-md-2">Remarks</label>
								<div class="col-md-4">							
									<textarea class="form-control" type="text" placeholder="Remarks" name="remarks"><?php if(isset($remarks)){echo $remarks;}?></textarea>
									<input type="hidden" value="<?php if(isset($id)){echo $id;}?>" name="id">
								</div>
							
						</div>
						<div class="form-group row">
							<label class="control-label col-md-2">Upload Image</label>
							<div class="col-md-4">							
								 <input type="file" name="image" value="Upload">
							</div>
							
							<label class="control-label col-md-2">Upload Image1</label>
							<div class="col-md-4">							
								 <input type="file" name="image1" value="Upload">
							</div>
						</div>
						
						<div class="tile-footer">
							<div class="row">
								<div class="col-md-8 col-md-offset-3">
									<?php if(isset($id)){ ?>
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
						</div>
					</form>
				</div>
			</div>
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

	$('#date').bind("change",function () {
		var date1 = new Date($('#date').val());
		var date2 = new Date();
		
		var timeDiff = Math.abs(date2.getTime() - date1.getTime());
		var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
		$('#noofdays').val(diffDays-1);
	});
		
function discardefaulter(value)
{
if(confirm("Sure to delete record !!!") == true)
{
$.ajax({
type: 'post',
url: '<?php echo base_url();?>index.php/BlockTransporterController/discard',
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