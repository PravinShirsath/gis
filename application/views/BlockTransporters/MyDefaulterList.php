<?php 
 $uid=$this->session->userdata('userid');
if(isset($uid))
{
	$total=0;
include('includes/topbar.php');
include('includes/header.php'); 
//include('includes/sidebar.php');

?>
<style>
.pointer {cursor: pointer;}
</style>
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
	<h5 style="margin-left:20px;"><a href="<?php echo base_url();?>index.php/BlockTransporterController/create"><button>Add My Defaulter</button></a>
	<a href="<?php echo base_url();?>index.php/BlockTransporterController/myDefaulterList"><button style="background-color:powderblue;COLOR:black">My Defaulter list</button></a>
	<!--<a href="<?php echo base_url();?>index.php/BlockTransporterController/allDefaulterList"><button>All Defaulter list</button></a></h5>-->
</div>
	
       
        <div class="row">
		<div class="col-md-12">
			<div class="tile">
				
					<table class="table table-hover table-bordered" id="sampleTable" style="display:block;overflow:auto;">
						<thead>
							<tr>
								<th>Person Name -
								<font color="red" style="text-align:right;"><?php 
									if(isset($defaulter)){
										$total1=0;
									foreach($defaulter as $de){
										$pamount=$de->pending_amount;
										$total1=$total1+1;
										}
									}
										echo '  Count '.number_format($total1);
								?></font></th>
								<th>Distributor Name </th>                    
								<th>Aadhar No </th>                    
								<th>PAN No </th>                    
								<th>District</th>                   
								<th>Mobile</th>
								                 
								<th>Pending Amount - 
								<font color="red" style="text-align:right;"><?php 
									if(isset($defaulter)){
									foreach($defaulter as $de){
										$pamount=$de->pending_amount;
										$total=$total+$pamount;
										}
									}
										echo '  Rs. '.number_format($total);
								?></font>
								</th>
								<th>No of Days</th>
								<th>Remarks</th> 
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>  
							<?php 
								if(isset($defaulter)){
								foreach($defaulter as $defaulter){
							?>
							<tr>
								<td><p class="pointer" data-toggle="modal" data-target="#myModal<?php echo $defaulter->id;?>"><i class="fa fa-address-card" style="font-size:15px;color:red;"></i> &nbsp;<?php echo $defaulter->person_name;?></a>
								<div id="myModal<?php echo $def_id=$defaulter->id;?>" class="modal fade" role="dialog">
								<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
											<h5 style="color:red;">Defaulter Details</h5>
												<button type="button" class="close" data-dismiss="modal"><h4 style="color:red;">X</h4></button>												
											</div>
											<div class="modal-body">
											<?php 	$this->db->select('*');				
													$qu=$this->db->get_where('blocktransporter',array('id'=>$def_id));
													$qurow=$qu->row();
													$qurow->person_name;					
											?>
											<div class="form-group row">
												<label class="control-label col-md-2">Person Name : </label>
												<div class="col-md-4">	
													<b style="color:red;"><?php	echo strtoupper($qurow->person_name); ?></b>												
												</div>
												<label class="control-label col-md-2">Party Name : </label>
												<div class="col-md-4">	
												<b style="color:red;"><?php	echo strtoupper($qurow->company_name); ?>	</b>												
												</div>
											</div>
											
											<div class="form-group row">
											<label class="control-label col-md-2">Person Name2 : </label>
											<div class="col-md-4">	
												<b style="color:red;"><?php	echo strtoupper($qurow->personename2); ?></b>												
											</div>
											<label class="control-label col-md-2">Person Name3 : </label>
											<div class="col-md-4">	
											<b style="color:red;"><?php	echo strtoupper($qurow->personename3); ?>	</b>												
											</div>
											</div>	
											<div class="form-group row">
											<label class="control-label col-md-2">Person Name4 : </label>
											<div class="col-md-4">	
												<b style="color:red;"><?php	echo strtoupper($qurow->personename4); ?></b>												
											</div>
											<label class="control-label col-md-2">Person Name5 : </label>
											<div class="col-md-4">	
											<b style="color:red;"><?php	echo strtoupper($qurow->personename5); ?>	</b>												
											</div>
											</div>
											<div class="form-group row">
												<label class="control-label col-md-2">Aadhar No : </label>
												<div class="col-md-4">	
													<b style="color:red;"><?php	echo strtoupper($qurow->aadharno); ?></b>												
												</div>
												<label class="control-label col-md-2">PAN No : </label>
												<div class="col-md-4">	
												<b style="color:red;"><?php	echo strtoupper($qurow->panno); ?>	</b>												
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
													<label class="control-label col-md-2">Remarks : </label>
													<div class="col-md-4">	
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
														
								</td>
								<td><?php echo $defaulter->company_name;?></td>                    
								<td><?php echo $defaulter->aadharno;?></td>                    
								<td><?php echo $defaulter->panno;?></td>                    
                                <td><?php $cityId=$defaulter->city;
                                    	$this->db->select('name');				
										$this->db->where(array('id'=>$cityId));	
										$query=$this->db->get('cities');
										$cityname=$query->result();
										if(isset($cityname))
										{
											foreach($cityname as $city)
											{
												echo $city->name;  
											}   
										}                           
                                ?></td>                   
								<td><?php echo $defaulter->mobile1;?></td>
								                
								<td align="right"><?php $pamount=$defaulter->pending_amount;
										if($pamount==0)
											{
												echo '0';
											}
											else
											{
												echo number_format($pamount);
											}					
								?></td>
								<td><input type="hidden" value="" name="">
								<b><?php $date1=date_create($defaulter->default_date);
										 $date2=date_create(date('Y-m-d'));
										 $diff=date_diff($date1,$date2);
										 echo $diff->format("%a"); ?></b></td>
								<td><?php echo $defaulter->remarks;?></td>   
							<td><a name='edit' href="<?php echo site_url('BlockTransporterController/edit/'.$id=$defaulter->id); ?>"><button title="Edit"  name="Edit" id="Edit" class="btn btn-primary"> Edit</button></a></td>                                               
								<td><button title="Delete" class="btn btn-danger" name="delete" id="delete" value="<?php echo $defaulter->id; ?>" onclick="discardefaulter(this.value);"> Delete</button></td>                   
							</tr>
							<?php }
						 } 
						 ?>
						</tbody>
					</table>
				
			</div>
		</div>
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

<script>
$('#sampleTable').DataTable();

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