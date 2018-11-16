<?php 
 $uid=$this->session->userdata('userid');
 $role=$this->session->userdata('role');
if(isset($uid))
{
include('includes/topbar.php');
include('includes/header.php'); 

?>

<main class="app-content">								
<div class="row">
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
			<h5 style="color:red;">Defaulter Details</h5>
				<button type="button" class="close" data-dismiss="modal"><h4 style="color:red;">X</h4></button>												
			</div>
				<div class="modal-body">
					<?php 	
							if(isset($defaulterId)){
							$this->db->select('*');				
							$qu=$this->db->get_where('blocktransporter',array('id'=>$defaulterId));
							$qurow=$qu->row();
							$updatedBy=$qurow->updatet_by;
							}
							
							if(isset($updatedBy)){
								$this->db->select('*');				
								$qu10=$this->db->get_where('users',array('id'=>$updatedBy));
								$qurow10=$qu10->row();
								$mobile=$qurow10->mobile;														
							}
							
							if(isset($mobile)){
								$this->db->select('*');				
								$qu1=$this->db->get_where('pumps',array('mobileNo'=>$mobile));
								$qurow1=$qu1->row();																											
							}	
					?>		
				<h5>Defaulter Added By</h5><br>
				<div class="form-group row">
					<label class="control-label col-md-2">Agency Owner Name : </label>
					<div class="col-md-4">	
						<b><?php	echo strtoupper($qurow1->ownerName); ?></b>												
					</div>
					<label class="control-label col-md-2">Agency Name : </label>
					<div class="col-md-4">	
					<b><?php	echo strtoupper($qurow1->name); ?>	</b>												
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-md-2">Mobile No : </label>
					<div class="col-md-4">	
						<b><?php	echo strtoupper($qurow1->mobileNo); ?></b>												
					</div>
					<label class="control-label col-md-2">City : </label>
					<div class="col-md-4">	
					<b><?php	$cId=$qurow1->cityId;
					if(isset($cId)){
							$this->db->select('name');				
							$qu2=$this->db->get_where('cities',array('id'=>$cId));
							$qurow2=$qu2->row();	
							echo strtoupper($qurow2->name);														
						}													
					 ?>	</b>												
					</div>
				</div>						
				<hr>
				<h5>Defaulter Transporter Details</h5><br>
				
				<div class="form-group row">
					<label class="control-label col-md-2">Person Name : </label>
					<div class="col-md-4">	
						<b style="color:red;"><?php	echo strtoupper($qurow->person_name); ?></b>												
					</div>
					<label class="control-label col-md-2">Person Name2 : </label>
					<div class="col-md-4">	
					<b style="color:red;"><?php	echo strtoupper($qurow->personename2); ?>	</b>												
					</div>
				</div>
				
				<div class="form-group row">
					<label class="control-label col-md-2">Person Name3 : </label>
					<div class="col-md-4">	
						<b style="color:red;"><?php	echo strtoupper($qurow->personename3); ?></b>												
					</div>
					<label class="control-label col-md-2">Transporter : </label>
					<div class="col-md-4">	
					<b style="color:red;"><?php	echo strtoupper($qurow->company_name); ?>	</b>												
					</div>
				</div>

				<div class="form-group row">
					<label class="control-label col-md-2">Region : </label>
					<div class="col-md-4">	
					<b><?php	$regionId=$qurow->region;
						$this->db->select('*');				
						$qu1=$this->db->get_where('regions',array('id'=>$regionId));
						$qurow1=$qu1->row();
						echo $qurow1->name;	
					 ?>		</b>											
					</div>
					<label class="control-label col-md-2">City : </label>
					<div class="col-md-4">	
					<b><?php	$cityId=$qurow->city;
						$this->db->select('*');				
						$qu=$this->db->get_where('cities',array('id'=>$cityId));
						$qurow2=$qu->row();
						echo $qurow2->name;	
					 ?>		</b>											
					</div>
				</div>

				<div class="form-group row">
					<label class="control-label col-md-2">e-Mail : </label>
					<div class="col-md-4">	
					<b><?php	echo $qurow->email; ?>		</b>											
					</div>
					<label class="control-label col-md-2">Address : </label>
					<div class="col-md-4">	
					<b><?php	echo $qurow->address; ?></b>													
					</div>
				</div>

				<div class="form-group row">
					<label class="control-label col-md-2">Mobile No.1 : </label>
					<div class="col-md-4">	
					<b><?php	echo $qurow->mobile1; ?>	</b>												
					</div>
					<label class="control-label col-md-2">Mobile No.2 : </label>
					<div class="col-md-4">	
					<b><?php	echo $qurow->mobile2; ?>	</b>												
					</div>
				</div>

				<div class="form-group row">
					<label class="control-label col-md-2">Mobile No.3 : </label>
					<div class="col-md-4">	
					<b><?php	echo $qurow->mobile3; ?></b>													
					</div>
					<label class="control-label col-md-2">Mobile No.4 : </label>
					<div class="col-md-4">	
					<b><?php	echo $qurow->mobile4; ?>	</b>												
					</div>
				</div>

				<div class="form-group row">
					<label class="control-label col-md-2">Defaulter since :  </label>
					<div class="col-md-4">	
					<b style="color:red;"><?php	 echo date("d M Y",strtotime($qurow->default_date));					
						
					?></b>
					<input type="hidden" name="defaultdate" id="date" value="<?php echo $qurow->default_date; ?>">													
					</div>
					<label class="control-label col-md-2">Pending Rs.: </label>
					<div class="col-md-4">	
					<b style="color:red;"><?php	echo number_format($qurow->pending_amount); ?>	</b>												
					</div>
				</div>	

				<div class="form-group row">
					<label class="control-label col-md-2">No. of Days : </label>
					<div class="col-md-4">	
					<b><?php $date1=date_create($qurow->default_date);
					$date2=date_create(date('Y-m-d'));
					$diff=date_diff($date1,$date2);
					echo $diff->format("%a"); ?></b>
					<script>
						$(document).ready(function(){
							var date1 = new Date($('#date').val());
							var date2 = new Date();
							
							var timeDiff = Math.abs(date2.getTime() - date1.getTime());
							var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
							$('#noofdays').val(diffDays-1);

							alert(diffDays);

						}); 
					</script>											
					</div>												
				</div>								

				<div class="form-group row">
					<label class="control-label col-md-2">Remarks : </label>
					<div class="col-md-10">	
					<b><?php	echo $qurow->remarks; ?>	</b>												
					</div>
				</div>									
			<div class="form-group row">
				<label class="control-label col-md-2">Person1: </label>
				<div class="team-member-image-inner col-md-4">
				<img src="<?php echo base_url();?>uploads/<?php echo $qurow->gallery_image; ?> "style="height:60px;width:60px;" alt="">   
				</div>
				<label class="control-label col-md-2">Person2: </label>
				<div class="team-member-image-inner col-md-4">
				<img src="<?php echo base_url();?>uploads/<?php echo $qurow->gallery_image1;?>" style="height:60px;width:60px;" alt="">   
				</div>
			</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>		
<div class="clearix"></div>
</div>
</div>
	
</main>
<?php include('includes/footer.php');?>

	<script type="text/javascript">
	$(document).ready(function(){
		$("#myModal").modal('show');
		setTimeout(function(){ window.location = "<?php echo base_url();?>index.php/BlockTransporterController/index"; }, 30000);
	});
</script>
<?php } else{ ?><script>
window.location.href = "<?php echo base_url();?>";
</script><?php } ?>